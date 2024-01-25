<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentGatewaySetting;
use App\Services\PaymentGatewaySettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentGatewaySettingController extends Controller
{
    use FileUploadTrait;
    public function index() : View {
        $paymentGateway = PaymentGatewaySetting::pluck('value', 'key');
        return view('admin.payment-setting.index', compact('paymentGateway'));
    }

    public function paypalSettingUpdate(Request $request) {
        $validateData = $request->validate([
            'paypal_status' => ['required', 'boolean'],
            'paypal_account_mode' => ['required', 'in:sandbox,live'],
            'paypal_country' => ['required'],
            'paypal_currency' => ['required'],
            'paypal_rate' => ['required', 'numeric'],
            'paypal_api_key' => ['required'],
            'paypal_secret_key' => ['required'],
            'paypal_app_id' => ['required'],
        ],
        [
                'paypal_status.required' => 'Paypal Durumu Zorunlu Alan!',
                'paypal_status.boolean' => 'Seçeneklerin Dışında Durum İletemezsiniz',
                'paypal_account_mode.required' => 'Paypal Hesap Modu Zorunlu Alan!',
                'paypal_account_mode.in' => 'Belirtilen Durum Dışı Veri Eklenemez',
                'paypal_country.required' => 'Ülke Bilgisi Zorunlu Alan!',
                'paypal_currency.required' => 'Para Birimi Zorunlu Alan!',
                'paypal_rate.required' => 'Lütfen Döviz Kuru Giriniz!',
                'paypal_rate.numeric' => 'Döviz Kuru Rakam Dışında Girilemez!',
                'paypal_api_key.required' => 'Lütfen Paypal Client ID Giriniz!',
                'paypal_secret_key.required' => 'Lütfen Paypal Secret Key Giriniz!',
                'paypal_app_id.required' => 'Lütfen Paypal App ID Giriniz!',
        ]);

        if ($request->hasFile('paypal_logo')){
            $request->validate(
                ['paypal_logo' => ['nullable', 'image']],
                ['paypal_logo.image' => 'Logo Alanına Görsel Dışında Dosya Ekleyemezsiniz!']);

            $imagePath = $this->uploadImage($request, 'paypal_logo');
            PaymentGatewaySetting::updateOrCreate(
                ['key' => 'paypal_logo'],
                ['value' => $imagePath],
            );
        }

        foreach ($validateData as $key => $value){
            PaymentGatewaySetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value],
            );
        }

        $settingsService = app(PaymentGatewaySettingService::class);
        $settingsService->clearCachedSettings();

        toastr()->success('Başarıyla Düzenlendi');
        return redirect()->back();
    }





}
