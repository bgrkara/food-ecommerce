@extends('admin.layouts.master')
@section('content')
    @push('css')
        <style>
            .form-control::-webkit-inner-spin-button,
            .form-control::-webkit-outer-spin-button {
                -webkit-appearance: none;   margin: 0;
            }
        </style>
    @endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Teslimat Alanı Güncelle</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                </div>
                <form action="{{ route('admin.delivery-area.update', $area->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Category -->
                    <div class="card-body">
                        <div class="col-md-12 col-12 mb-3">
                            <label for="areaName" class="form-label">Teslimat Alanı Adı</label>
                            <input
                                class="form-control"
                                type="text"
                                id="areaName"
                                name="area_name"
                                value="{{ $area->area_name }}"
                                placeholder="Teslimat Alanı Adı Giriniz"
                                autofocus
                            />
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="minDeliveryTime" class="form-label">Min. Teslimat Süresi</label>
                                <div class="input-group">
                                    <span class="input-group-text">Dakika</span>
                                    <input
                                        class="form-control"
                                        type="number"
                                        id="minDeliveryTime"
                                        name="min_delivery_time"
                                        value="{{ $area->min_delivery_time }}"
                                        placeholder="Min. Teslimat Süresi Giriniz"
                                        autofocus
                                    />
                                </div>
                                <small>Dakika (Dk) Cinsinden Giriniz</small>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="maxDeliveryTime" class="form-label">Max. Teslimat Süresi</label>
                                <div class="input-group">
                                    <span class="input-group-text">Dakika</span>
                                    <input
                                        class="form-control"
                                        type="number"
                                        id="maxDeliveryTime"
                                        name="max_delivery_time"
                                        value="{{ $area->max_delivery_time }}"
                                        placeholder="Max. Teslimat Süresi Giriniz"
                                        autofocus
                                    />
                                </div>
                                <small>Dakika (Dk) Cinsinden Giriniz</small>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="deliveryFee" class="form-label">Teslimat Ücreti</label>
                                <div class="input-group">
                                    <span class="input-group-text">{{ config('settings.site_currency_icon') }}</span>
                                    <input type="number" name="delivery_fee" id="deliveryFee" class="form-control" value="{{ $area->delivery_fee }}" placeholder="50" aria-label="Tutar">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="select" class="form-label">Durum</label>
                                <select name="status" id="select" class="form-select">
                                    <option @selected($area->status === 1) value="1">Aktif</option>
                                    <option @selected($area->status === 0) value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Güncelle" />
                            <a href="{{ route('admin.delivery-area.index') }}" class="btn btn-label-secondary">İptal</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Media -->
        </div>
    </div>
@endsection
