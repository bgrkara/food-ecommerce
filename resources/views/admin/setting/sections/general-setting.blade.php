<div class="tab-pane fade active show" id="general-setting" role="tabpanel">
    <form action="{{ route('admin.general-setting.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="site-name">Site Adı</label>
                <input type="text" name="site_name" id="site-name" class="form-control" placeholder="Site Adını Giriniz" value="{{ config('settings.site_name') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="default-currency">Varsayılan Para Birimi</label>
                <select name="site_default_currency" id="default-currency" class="select2 form-select" data-allow-clear="true">
                    <option value="">Para Birimi Seçiniz</option>
                    @foreach(config('currencys.currency_list') as $key => $value)
                        <option @selected(config('settings.site_default_currency') === $value) value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="currency-icon">Para Birimi İconu</label>
                <input type="text" name="site_currency_icon" id="currency-icon" class="form-control" maxlength="4" placeholder="Para Birimi İconu Giriniz" value="{{ config('settings.site_currency_icon') }}" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="currency-icon-position">Para Birimi İcon Konumu</label>
                <select name="site_currency_icon_position" id="currency-icon-position" class="select2 form-select" data-allow-clear="true">
                    <option @selected(config('settings.site_currency_icon_position') === 'right') value="right">Sağ</option>
                    <option @selected(config('settings.site_currency_icon_position') === 'left') value="left">Sol</option>
                </select>
            </div>

        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Kaydet</button>
        </div>
    </form>
</div>
