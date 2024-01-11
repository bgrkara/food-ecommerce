@extends('admin.layouts.master')
@push('css')<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/flatpickr/flatpickr.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/pickr/pickr-themes.css') }}">
<style>
    .form-control::-webkit-inner-spin-button,
    .form-control::-webkit-outer-spin-button {
        -webkit-appearance: none;   margin: 0;
    }
    .odd td{
        font-size: 13px !important;
    }
</style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Kupon Düzenle</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                </div>
                <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Category -->
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="couponName" class="form-label">Kupon Adı</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="couponName"
                                    name="name"
                                    placeholder="Kupon Adı Giriniz"
                                    value="{{ $coupon->name }}"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="couponCode" class="form-label">Kupon Kodu</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="couponCode"
                                    name="code"
                                    maxlength="15"
                                    oninput="this.value = this.value.toUpperCase()"
                                    placeholder="Kupon Kodu Giriniz"
                                    value="{{ $coupon->code }}"
                                    autofocus
                                />
                                <small>Maksimum 15 Karakter Ekleyebilirsiniz</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="couponQuantity" class="form-label">Kupon Miktarı</label>
                                <div class="input-group">
                                    <span class="input-group-text">Adet</span>
                                    <input type="number" name="quantity" id="couponQuantity" class="form-control" value="{{ $coupon->quantity }}" placeholder="50" aria-label="Miktar">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="minPurchasePrice" class="form-label">Minimum Satın Alma Fiyatı</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ config('settings.site_currency_icon') }}</span>
                                    <input type="number" name="min_purchase_amount" id="minPurchasePrice" class="form-control" value="{{ $coupon->min_purchase_amount }}" placeholder="50" aria-label="Tutar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="couponDiscount" class="form-label">İndirim</label>
                                <div class="input-group">
                                    <span class="input-group-text">(%) / ({{ config('settings.site_currency_icon') }})</span>
                                    <input type="number" name="discount" id="couponDiscount" class="form-control" value="{{ $coupon->discount }}" placeholder="50" aria-label="Tutar">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-4">
                                <label for="expireDate" class="form-label">Sona Erme Tarihi</label>
                                <input type="text" class="form-control flatpickr-input" name="expire_date" placeholder="GG-AA-YYYY" id="expireDate" value="{{ $coupon->expire_date }}" readonly="readonly">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="discountType" class="form-label">İndirim Türü</label>
                                <select name="discount_type" id="discountType" class="form-select">
                                    <option @selected($coupon->discount_type === 'percent') value="percent">Yüzde İndirimi (%)</option>
                                    <option @selected($coupon->discount_type === 'amount') value="amount">Tutar İndirimi ({{ config('settings.site_currency_icon') }})</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="select" class="form-label">Durum</label>
                                <select name="status" id="select" class="form-select">
                                    <option @selected($coupon->status === 1) value="1">Aktif</option>
                                    <option @selected($coupon->status === 0) value="0">Pasif</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Güncelle" />
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-label-secondary">İptal</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Media -->
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/pickr/pickr.js') }}"></script>
    <script src="{{ asset('admin/assets/js/forms-pickers.js') }}"></script>
    <script>
        $("input#couponCode").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });
    </script>
@endpush
