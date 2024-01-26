<div class="tab-pane fade" id="iyzico-setting" role="tabpanel">
    <form action="{{ route('admin.iyzico-setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="iyzicoStatus">Iyzico Durum</label>
                <select name="iyzico_status" id="iyzicoStatus" class="select2 form-select" data-allow-clear="true">
                    <option @selected(@$paymentGateway['iyzico_status'] === '1') value="1">Aktif</option>
                    <option @selected(@$paymentGateway['iyzico_status'] === '0') value="0">Pasif</option>
                </select>
            </div>
{{--            <div class="col-md-6">--}}
{{--                <label class="form-label" for="paypalAccount_mode">iyzico Hesap Modu</label>--}}
{{--                <select name="paypal_account_mode" id="paypalAccount_mode" class="select2 form-select" data-allow-clear="true">--}}
{{--                    <option @selected(@$paymentGateway['paypal_account_mode'] === 'sandbox') value="sandbox">Sandbox</option>--}}
{{--                    <option @selected(@$paymentGateway['paypal_account_mode'] === 'live') value="live">Canlı</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="col-md-6">
                <label class="form-label" for="iyzico-country">Iyzico Ülke Adı</label>
                <select name="iyzico_country" id="iyzico-country" class="select2 form-select" data-allow-clear="true">
                    @foreach(config('country_list') as $key => $country)
                        <option @selected(@$paymentGateway['iyzico_country'] === $key) value="{{ $key }}">{{ $country }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="iyzico-currency">Iyzico Para Birimi</label>
                <select name="iyzico_currency" id="iyzico-currency" class="select2 form-select" data-allow-clear="true">
                    <option value="">Para Birimi Seçiniz</option>
                    @foreach(config('currencys.currency_list') as $key => $value)
                        <option @selected(@$paymentGateway['iyzico_currency'] === $value) value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="currency_iyzico_rate">Döviz Kuru ({{ config('settings.site_default_currency') }})</label>
                <input type="text" name="iyzico_rate" id="currency_iyzico_rate" class="form-control" placeholder="Döviz Kuru Giriniz" value="{{ @$paymentGateway['iyzico_rate'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="iyzico_client_id">Iyzico API Key</label>
                <input type="text" name="iyzico_api_key" id="iyzico_client_id" class="form-control" placeholder="iyzico API Key" value="{{ @$paymentGateway['iyzico_api_key'] }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="iyzico-secret-key">Iyzico Secret Key</label>
                <input type="text" name="iyzico_secret_key" id="iyzico-secret-key" class="form-control" placeholder="iyzico Secret Key" value="{{ @$paymentGateway['iyzico_secret_key'] }}" />
            </div>
                <!-- Image -->
            <div class="col-md-6 pay-img-content">
                <div class="iyzico_img_content">
                    <img
                        src=" {{ @$paymentGateway['iyzico_logo'] }} "
                        alt="user-avatar"
                        class="d-block sw-px-100 sh-px-100 rounded"
                        id="uploadedLogo" />
                </div>
                <div class="button-wrapper product-image-center">
                    <label for="uploadIyzico" class="btn btn-primary me-2" tabindex="0">
                        <span class="d-none d-sm-block">Logo Yükle</span>
                        <i class="ti ti-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="uploadIyzico"
                            name="iyzico_logo"
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
