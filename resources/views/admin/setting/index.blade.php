@extends('admin.layouts.master')
@push('css')
    <style>
        ul.nav-tabs{
            min-width: 200px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Site Ayarları</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Tüm Ayarlar</h5>
                </div>
            </div>
            <!-- /Media -->

            <!-- Form with Tabs -->
            <div class="row">
                <div class="col">
                    <h6 class="mt-4">Site Ayarları</h6>
                    <div class="card mb-3">
                        <div class="card-header pt-2">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button
                                        class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#general-setting"
                                        role="tab"
                                        aria-selected="true">
                                        Genel Ayarlar
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#form-tabs-account"
                                        role="tab"
                                        aria-selected="false">
                                        Account Details
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#form-tabs-social"
                                        role="tab"
                                        aria-selected="false">
                                        Social Links
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
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
                            <div class="tab-pane fade" id="form-tabs-account" role="tabpanel">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-username">Username</label>
                                            <input type="text" id="formtabs-username" class="form-control" placeholder="john.doe" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-email">Email</label>
                                            <div class="input-group input-group-merge">
                                                <input
                                                    type="text"
                                                    id="formtabs-email"
                                                    class="form-control"
                                                    placeholder="john.doe"
                                                    aria-label="john.doe"
                                                    aria-describedby="formtabs-email2" />
                                                <span class="input-group-text" id="formtabs-email2">@example.com</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="formtabs-password">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input
                                                        type="password"
                                                        id="formtabs-password"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="formtabs-password2" />
                                                    <span class="input-group-text cursor-pointer" id="formtabs-password2"
                                                    ><i class="ti ti-eye-off"></i
                                                        ></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-password-toggle">
                                                <label class="form-label" for="formtabs-confirm-password">Confirm Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input
                                                        type="password"
                                                        id="formtabs-confirm-password"
                                                        class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                        aria-describedby="formtabs-confirm-password2" />
                                                    <span class="input-group-text cursor-pointer" id="formtabs-confirm-password2"
                                                    ><i class="ti ti-eye-off"></i
                                                        ></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="form-tabs-social" role="tabpanel">
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-twitter">Twitter</label>
                                            <input
                                                type="text"
                                                id="formtabs-twitter"
                                                class="form-control"
                                                placeholder="https://twitter.com/abc" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-facebook">Facebook</label>
                                            <input
                                                type="text"
                                                id="formtabs-facebook"
                                                class="form-control"
                                                placeholder="https://facebook.com/abc" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-google">Google+</label>
                                            <input
                                                type="text"
                                                id="formtabs-google"
                                                class="form-control"
                                                placeholder="https://plus.google.com/abc" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-linkedin">Linkedin</label>
                                            <input
                                                type="text"
                                                id="formtabs-linkedin"
                                                class="form-control"
                                                placeholder="https://linkedin.com/abc" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-instagram">Instagram</label>
                                            <input
                                                type="text"
                                                id="formtabs-instagram"
                                                class="form-control"
                                                placeholder="https://instagram.com/abc" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="formtabs-quora">Quora</label>
                                            <input
                                                type="text"
                                                id="formtabs-quora"
                                                class="form-control"
                                                placeholder="https://quora.com/abc" />
                                        </div>
                                    </div>
                                    <div class="pt-4">
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                        <button type="reset" class="btn btn-label-secondary">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@push('scripts')
@endpush

