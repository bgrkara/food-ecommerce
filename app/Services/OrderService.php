<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderService {

    /** Store Order In Database **/
    function createOrder(){

        try {
            $order = new Order();
            $order->invoice_id = generateInvoiceId();
            $order->user_id  = auth()->user()->id;
            $order->address  = session()->get('address');
            $order->discount  = session()->get('coupon') ? session()->get('coupon')['discount'] : 0;
            $order->delivery_charge  = session()->get('delivery_fee');
            $order->subtotal  = cartTotal();
            $order->grand_total  = grandCartTotal(session()->get('delivery_fee'));
            $order->product_qty  = Cart::content()->count();
            $order->payment_method  = NULL;
            $order->payment_status  = 'pending';
            $order->payment_approve_date  = NULL;
            $order->transection_id  = NULL;
            $order->coupon_info  = session()->get('coupon') ? json_encode(session()->get('coupon')) : NULL;
            $order->currency_name  = NULL;
            $order->order_status  = 'pending';
            $order->save();

            foreach (Cart::content() as $product){
                $orderItem = new OrderItem();
                $orderItem->order_id  = $order->id;
                $orderItem->product_name  = $product->name;
                $orderItem->product_id  = $product->id;
                $orderItem->unit_price  = $product->price;
                $orderItem->qty  = $product->qty;
                $orderItem->product_size  = $product->options->product_size ? json_encode($product->options->product_size) : NULL;
                $orderItem->product_option  = $product->options->product_options ? json_encode($product->options->product_options) : NULL;
                $orderItem->save();

            }

            /** Putting The Order ID in Session **/
            session()->put('order_id',$order->id);

            /** Putting The Grand Total Amount in Session **/
            session()->put('grand_total',$order->grand_total);

            return true;

        }catch (\Exception $e){
            logger($e);
            return false;
        }



    }

    /** Clear Session Item **/
    function clearSession(){

    }

}
