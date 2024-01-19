<div class="tab-pane fade active show" id="paypal-setting" role="tabpanel">
    <form action="{{ route('admin.paypal-setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="paypalStatus">Paypal Durum</label>
                <select name="paypal_status" id="paypalStatus" class="select2 form-select" data-allow-clear="true">
                    <option @selected($paymentGateway['paypal_status'] === '1') value="1">Aktif</option>
                    <option @selected($paymentGateway['paypal_status'] === '0') value="0">Pasif</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="paypalAccount_mode">Paypal Hesap Modu</label>
                <select name="paypal_account_mode" id="paypalAccount_mode" class="select2 form-select" data-allow-clear="true">
                    <option @selected($paymentGateway['paypal_account_mode'] === 'sandbox') value="sandbox">Sandbox</option>
                    <option @selected($paymentGateway['paypal_account_mode'] === 'live') value="live">Canlı</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="paypal-country">Paypal Ülke Adı</label>
                <select name="paypal_country" id="paypal-country" class="select2 form-select" data-allow-clear="true">
                    <option value="">Bir Ülke Seçiniz</option>
                    @foreach(config('country_list') as $key => $country)
                        <option @selected($paymentGateway['paypal_country'] === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="payp-currency">Paypal Para Birimi</label>
                <select name="paypal_currency" id="payp-currency" class="select2 form-select" data-allow-clear="true">
                    <option value="">Para Birimi Seçiniz</option>
                    @foreach(config('currencys.currency_list') as $key => $value)
                        <option @selected($paymentGateway['paypal_currency'] === $value) value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="currency_rate">Döviz Kuru ({{ config('settings.site_default_currency') }})</label>
                <input type="text" name="paypal_rate" id="currency_rate" class="form-control" placeholder="Döviz Kuru Giriniz" value="{{ $paymentGateway['paypal_rate'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="paypal_client_id">Paypal Client ID</label>
                <input type="text" name="paypal_api_key" id="paypal_client_id" class="form-control" placeholder="Paypal Client ID" value="{{ $paymentGateway['paypal_api_key'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="paypal-secret-key">Paypal Secret Key</label>
                <input type="text" name="paypal_secret_key" id="paypal-secret-key" class="form-control" placeholder="Paypal Secret Key" value="{{ $paymentGateway['paypal_secret_key'] }}" />
            </div>
                <!-- Image -->
            <div class="col-md-6 pay-img-content">
                <div class="paypal_img_content">
                    <img
                        src=" {{ $paymentGateway['paypal_logo'] }} "
                        alt="user-avatar"
                        class="d-block sw-px-100 sh-px-100 rounded"
                        id="uploadedLogo" />
                </div>
                <div class="button-wrapper product-image-center">
                    <label for="upload" class="btn btn-primary me-2" tabindex="0">
                        <span class="d-none d-sm-block">Logo Yükle</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="upload"
                            name="paypal_logo"
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
