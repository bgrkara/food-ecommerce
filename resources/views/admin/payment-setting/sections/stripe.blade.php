<div class="tab-pane fade" id="stripe-setting" role="tabpanel">
    <form action="{{ route('admin.stripe-setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="stripeStatus">Stripe Durum</label>
                <select name="stripe_status" id="stripeStatus" class="select2 form-select" data-allow-clear="true">
                    <option @selected(@$paymentGateway['stripe_status'] === '1') value="1">Aktif</option>
                    <option @selected(@$paymentGateway['stripe_status'] === '0') value="0">Pasif</option>
                </select>
            </div>
{{--            <div class="col-md-6">--}}
{{--                <label class="form-label" for="paypalAccount_mode">Stripe Hesap Modu</label>--}}
{{--                <select name="paypal_account_mode" id="paypalAccount_mode" class="select2 form-select" data-allow-clear="true">--}}
{{--                    <option @selected(@$paymentGateway['paypal_account_mode'] === 'sandbox') value="sandbox">Sandbox</option>--}}
{{--                    <option @selected(@$paymentGateway['paypal_account_mode'] === 'live') value="live">Canlı</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="col-md-6">
                <label class="form-label" for="stripe-country">Stripe Ülke Adı</label>
                <select name="stripe_country" id="stripe-country" class="select2 form-select" data-allow-clear="true">
                    @foreach(config('country_list') as $key => $country)
                        <option @selected(@$paymentGateway['stripe_country'] === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="stripe-currency">Stripe Para Birimi</label>
                <select name="stripe_currency" id="stripe-currency" class="select2 form-select" data-allow-clear="true">
                    <option value="">Para Birimi Seçiniz</option>
                    @foreach(config('currencys.currency_list') as $key => $value)
                        <option @selected(@$paymentGateway['stripe_currency'] === $value) value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="currency_stripe_rate">Döviz Kuru ({{ config('settings.site_default_currency') }})</label>
                <input type="text" name="stripe_rate" id="currency_stripe_rate" class="form-control" placeholder="Döviz Kuru Giriniz" value="{{ @$paymentGateway['stripe_rate'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="stripe_client_id">Stripe Key</label>
                <input type="text" name="stripe_api_key" id="stripe_client_id" class="form-control" placeholder="Stripe Key" value="{{ @$paymentGateway['stripe_api_key'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="stripe-secret-key">Stripe Secret Key</label>
                <input type="text" name="stripe_secret_key" id="stripe-secret-key" class="form-control" placeholder="Stripe Secret Key" value="{{ @$paymentGateway['stripe_secret_key'] }}" />
            </div>
                <!-- Image -->
            <div class="col-md-6 pay-img-content">
                <div class="stripe_img_content">
                    <img
                        src=" {{ @$paymentGateway['stripe_logo'] }} "
                        alt="user-avatar"
                        class="d-block sw-px-100 sh-px-100 rounded"
                        id="uploadedLogo" />
                </div>
                <div class="button-wrapper product-image-center">
                    <label for="uploadStripe" class="btn btn-primary me-2" tabindex="0">
                        <span class="d-none d-sm-block">Logo Yükle</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="uploadStripe"
                            name="stripe_logo"
                            class="account-file-input"
                            hidden
                            accept="image/png, image/jpeg, image/gif" />
                    </label>
                    <button type="button" class="btn btn-label-secondary account-image-reset">
                        <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Sıfırla</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Kaydet</button>
        </div>
    </form>
</div>
