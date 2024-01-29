<?php

namespace App\Http\Controllers\Frontend;

use App\Events\OrderPaymentUpdateEvent;
use App\Events\OrderPlaceNotificationEvent;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\CheckoutFormInitialize;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Model\ThreedsInitialize;
use Iyzipay\Options;
use Iyzipay\Request\CreateCheckoutFormInitializeRequest;
use Iyzipay\Request\CreatePaymentRequest;
use Iyzipay\Model\Payment;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Address;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\Exception\InvalidRequestException;

class PaymentController extends Controller
{
    public function index() : View
    {
        if (!session()->has('delivery_fee') || !session()->has('address')){
            throw ValidationException::withMessages('İşlemi Gerçekleştirirken Birşeyler Yanlış Gitti!');
        }
        $subtotal = CartTotal();
        $delivery = session()->get('delivery_fee') ?? 0;
        $discount = session()->get('coupon')['discount'] ?? 0;
        $grandTotal = grandCartTotal($delivery);
        $paymentInput = $this->payWithIyzico();
        return view('frontend.pages.payment', compact('subtotal', 'delivery', 'discount', 'grandTotal', 'paymentInput'));
    }

    public function paymentSuccess() : View {
        return view('frontend.pages.payment-success');
    }

    public function paymentCancel() : View {
        return view('frontend.pages.payment-cancel');
    }

    public function makePayment(Request $request , OrderService $orderService)
    {
        $request->validate([
            'payment_gateway' => ['required', 'string', 'in:paypal,stripe,iyzico']
        ]);
        /** Create Order **/
        if ($orderService->createOrder()){
            // Redirect User To The Payment Host
            switch ($request->payment_gateway){
                case 'paypal':
                    return response(['redirect_url' => route('paypal.payment')]);
                    break;
                case 'stripe':
                    return response(['redirect_url' => route('stripe.payment')]);
                    break;
                case 'iyzico':
                    return response(['redirect_url' => route('iyzico.payment')]);
                    break;
                default:
                    break;
            }
        }
    }

    /** Paypal Payment **/

    public function setPaypalConfig() : array {
        $config = [
            'mode'    => config('gatewaySettings.paypal_account_mode'),
            'sandbox' => [
                'client_id'         => config('gatewaySettings.paypal_api_key'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => config('gatewaySettings.paypal_api_key'),
                'client_secret'     => config('gatewaySettings.paypal_secret_key'),
                'app_id'            => config('gatewaySettings.paypal_app_id'),
            ],

            'payment_action' => 'Sale',
            'currency'       => config('gatewaySettings.paypal_currency'),
            'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => false, // Validate SSL when creating api client.
        ];
        return $config;
    }

    public function payWithPaypal() {

        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        /** Calculate Payable Amount **/
        $grandTotal = session()->get('grand_total');
        $payableAmount = round($grandTotal * config('gatewaySettings.paypal_rate'));

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paypal.success'),
                'cancel_url' => route('paypal.cancel')
            ],
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => config('gatewaySettings.paypal_currency'),
                        'value' => $payableAmount
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != NULL){
            foreach ($response['links'] as $link){
                if ($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
//                else{
//                    return redirect()->route('payment.cancel')->withErrors(['status' => $response['error']['message']]);
//                    return redirect()->route('payment.cancel');
//                }
            }
        }

    }

    public function paypalSuccess(Request $request, OrderService $orderService) {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] === 'COMPLETED'){
            $orderId = session()->get('order_id');
            $capture = $response['purchase_units'][0]['payments']['captures'][0];
            $paymentInfo = [
              'transaction_id' => $capture['id'],
              'currency' => $capture['amount']['currency_code'],
              'status' =>  $capture['status'],
            ];

            OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'PayPal');
            OrderPlaceNotificationEvent::dispatch($orderId);

            /** Clear Session Data **/
            $orderService->clearSession();

            return redirect()->route('payment.success');
        }else{
            $this->transactionFailUpdateStatus('PayPal');
            return redirect()->route('payment.cancel')->withErrors(['error' => $response['error']['message']]);
        }
    }

    public function paypalCancel() {
        $this->transactionFailUpdateStatus('PayPal');
        return redirect()->route('payment.cancel');
    }

    /** Stripe Payment *
     * @throws ApiErrorException
     */

    function payWithStripe() {
        try {
            Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));

            $grandTotal = session()->get('grand_total');
            $payableAmount = round($grandTotal * config('gatewaySettings.stripe_rate')) * 100;

            $response = StripeSession::create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => config('gatewaySettings.stripe_currency'),
                            'product_data' => [
                                'name' => 'Product',
                            ],
                            'unit_amount' => $payableAmount,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel'),
            ]);

            return redirect()->away($response->url);
        } catch (InvalidRequestException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function stripeSuccess(Request $request, OrderService $orderService) {
        $sessionId = $request->session_id;
        Stripe::setApiKey(config('gatewaySettings.stripe_secret_key'));

        $response = StripeSession::retrieve($sessionId);

        if ($response->payment_status === 'paid'){

            $orderId = session()->get('order_id');
            $paymentInfo = [
                'transaction_id' => $response->payment_intent,
                'currency' => $response->currency,
                'status' =>  $response->status,
            ];

            OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, 'Stripe');
            OrderPlaceNotificationEvent::dispatch($orderId);

            /** Clear Session Data **/
            $orderService->clearSession();

            return redirect()->route('payment.success');
        }else{
            $this->transactionFailUpdateStatus('Stripe');
            return redirect()->route('payment.cancel');
        }
    }

    function stripeCancel() {
        $this->transactionFailUpdateStatus('Stripe');
        return redirect()->route('payment.cancel');
    }

        /** Iyzico Payment **/


    private function setIyzicoConfig() : array {
        $config = [
            'api_key'         => config('gatewaySettings.iyzico_api_key'),
            'secret_key'     => config('gatewaySettings.iyzico_secret_key'),
            'base_url'       => 'https://sandbox-api.iyzipay.com',
            'locale'         => 'tr_TR', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => false, // Validate SSL when creating api client.
        ];
        return $config;
    }

    function payWithIyzico() {

        /** ConversationId **/
        $rowId = '';
        foreach (session()->get('cart')["default"] as $item){ $rowId = $item->rowId; }
        $payableAmount = grandCartTotal(session()->get('delivery_fee')) * config('gatewaySettings.iyzico_rate');

        $options = new Options();
        $options->setApiKey($this->setIyzicoConfig()['api_key']);
        $options->setSecretKey($this->setIyzicoConfig()['secret_key']);
        $options->setBaseUrl($this->setIyzicoConfig()['base_url']);

        $request = new CreateCheckoutFormInitializeRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId($rowId);
        $request->setPrice($payableAmount);
        $request->setPaidPrice($payableAmount);
        $request->setCurrency(Currency::TL);
        $request->setBasketId($rowId);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);
        $request->setCallbackUrl(route('iyzico.success'));
        $request->setEnabledInstallments(array(2, 3, 6, 9));

        $buyer = new Buyer();
        $buyer->setId(auth()->user()->id);
        $buyer->setName(session()->get('buyer')['name']);
        $buyer->setSurname(session()->get('buyer')['surname']);
        $buyer->setGsmNumber(session()->get('buyer')['phone']);
        $buyer->setEmail(session()->get('buyer')['email']);
        $buyer->setIdentityNumber("11111111111");
        $buyer->setLastLoginDate(date('Y-m-d H:i:s', strtotime('-3 minutes')));
        $buyer->setRegistrationDate(date('Y-m-d H:i:s', strtotime('-1 day')));
        $buyer->setRegistrationAddress(session()->get('address'));
        $buyer->setIp(\request()->ip());
        $buyer->setCity(session()->get('buyer')['area']);
        $buyer->setCountry("Turkey");
        $buyer->setZipCode("06570");
        $request->setBuyer($buyer);

        $shippingAddress = new Address();
        $shippingAddress->setContactName(session()->get('buyer')['name'] . ' ' . session()->get('buyer')['surname']);
        $shippingAddress->setCity(session()->get('buyer')['area']);
        $shippingAddress->setCountry("Turkey");
        $shippingAddress->setAddress(session()->get('address'));
        $shippingAddress->setZipCode("06570");
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new Address();
        $billingAddress->setContactName(session()->get('buyer')['name'] . ' ' . session()->get('buyer')['surname']);
        $billingAddress->setCity(session()->get('buyer')['area']);
        $billingAddress->setCountry("Turkey");
        $billingAddress->setAddress(session()->get('address'));
        $billingAddress->setZipCode("06570");
        $request->setBillingAddress($billingAddress);

        $BasketItem = new BasketItem();
        foreach (Cart::content() as $item){
            $product = Product::with(['category'])->findOrFail($item->id);
            $BasketItem = new BasketItem();
            $BasketItem->setId($item->id);
            $BasketItem->setName($item->name);
            $BasketItem->setCategory1($product->category->name);
            $BasketItem->setItemType(BasketItemType::PHYSICAL);
            $optionsPrice = 0;
            $singleProductPrice = $item->price;
            $sizePrice = $item->options?->product_size['price'] ?? 0;
            foreach ($item->options->product_options as $option){
                $optionsPrice += $option['price'];
            }
            $deliveryFee = session()->get('delivery_fee') / count(Cart::content());
            if (session()->get('coupon') !== NULL){
                $discountFee = session()->get('coupon')['discount'] / count(Cart::content());
                $BasketItem->setPrice((($singleProductPrice + $sizePrice + $optionsPrice) * $item->qty) - $discountFee + $deliveryFee);
            }else{
                $BasketItem->setPrice((($singleProductPrice + $sizePrice + $optionsPrice) * $item->qty) + $deliveryFee);
            }
            $basketItems[] = $BasketItem;
        }
        $request->setBasketItems($basketItems);
        $checkoutFormInitialize = CheckoutFormInitialize::create($request, $options);
        return $checkoutFormInitialize->getCheckoutFormContent();

    }


//    function iyzicoSuccess(Request $request, OrderService $orderService) {
////            return redirect()->route('payment.success');
//    }

    function transactionFailUpdateStatus($gatewayName) : void{
        $orderId = session()->get('order_id');
        $paymentInfo = [
            'transaction_id' => '',
            'currency' => '',
            'status' =>  'Başarısız Oldu',
        ];

        OrderPaymentUpdateEvent::dispatch($orderId, $paymentInfo, $gatewayName);
    }

}
