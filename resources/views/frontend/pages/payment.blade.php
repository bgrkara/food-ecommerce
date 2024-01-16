@extends('frontend.layouts.master')
@push('css')
    <style>
        .title-head{
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        .ps-btn i {
            font-size: 13px !important;
        }
        .address-content{
            background-color: #f0f2f5;
            border-color: #ffffff;
            margin: 15px;
            padding: 10px;
            border-radius: 10px;
            min-height: 200px;
            max-height: 200px;
            transition: border-color 1s ease;
            cursor: pointer;
        }
        .selected {
            border: 3px solid #ff6000;
            opacity: 1;
        }
        .not-selected {
            opacity: 0.7;
        }
        .head-location{
            border: 1px solid;
            padding: 2px 11px;
            border-radius: 6px;
            cursor: default;
        }
        .address-submit-btn{
            border: none;
            padding: 4px 22px;
            border-radius: 25px;
            margin-top: 10px;
            color: #ffffff;
            background-color: #ff6000;
            cursor: pointer;
        }
        .address-cancel-btn{
            border: none;
            padding: 4px 22px;
            border-radius: 25px;
            margin-top: 10px;
            color: #ffffff;
            background-color: #999da3;
            cursor: pointer;
        }
        .address-cancel-btn:hover{background-color: #cbcccd;}
        .mb-80{
            margin-bottom: 80px;
        }
        .address-submit-btn:hover{background-color: #e1ca91;}
        .ps-form__submit > a:hover{color: #103178 !important;}
        .type-check-column{
            max-width: 200px;
            background-color: #f0f2f5;
        }
        .type-check-popup{
            padding: 6px;
            border-radius: 10px;
        }
        .type-check-popup label{
            color: #ff6000 !important;
        }
        .type-check-popup .form-check-label::before{
            top: 1px !important;
        }
        .type-check-popup .form-check-label::after {
            top: 0 !important;
        }
        .delivery-type{
            padding: 2px 15px;
            border-radius: 6px;
            border: 1px solid #ff6000;
            color: #ff6000 !important;
            font-weight: 500 !important;
            text-transform: capitalize;
        }
        .form-check .form-check-label::before {
            background: #9eacc1 !important;
            border-radius: 50px !important;
            width: 20px !important;
            height: 20px !important;
        }
        .head-column .form-check-label::before {
            top: 2px !important;
        }
        .head-column .form-check-label::after{
            top: 1px !important;
        }
        .form-check .form-check-label::after {
            left: 5px;
            top: 3px;
        }
        .ps-checkout .form-check label {
            font-size: 16px !important;
        }
        .ps-section--address{
            text-align: center;
            padding: 10px 25px;
        }
        .ps-checkout .ps-checkout__title{
            font-size: 35px !important;
        }
        .complete_order_icon{
            position: relative;
            bottom: 4px;
        }
        .ps-btn-address-add{
            display: inline-block;
            padding: 5px 15px;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.3s;
        }
        .ps-btn-address-add:hover {
            transform: scale(1.1);
        }
        .ps-product__name{
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .ps-checkout .form-check .agree-column{
            font-size: 14px !important;
        }
    </style>
@endpush
@section('content')
    <div class="ps-checkout ps-checkout__main">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page"> Ödeme</li>
            </ul>
            <h3 class="ps-checkout__title"><span class="complete_order_icon">&#128179;</span> Ödeme İşlemi</h3>
            <div class="ps-checkout__content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="ps-payment">
                            <div class="ps-payment__content">
                                <div class="ps-payment__tabs">
                                    <ul class="nav nav-tabs" id="productContentTabs" role="tablist">
                                        <li class="nav-item" role="presentation"><a class="nav-link active" id="payment-1-tab" data-toggle="tab" href="#payment-1-content" role="tab" aria-controls="payment-1-content" aria-selected="true">Kredi Kartı</a></li>
                                        <li class="nav-item" role="presentation"><a class="nav-link" id="payment-2-tab" data-toggle="tab" href="#payment-2-content" role="tab" aria-controls="payment-2-content" aria-selected="false">Paypal</a></li>
                                    </ul>
                                    <div class="tab-content" id="productContent">
                                        <div class="tab-pane fade show active" id="payment-1-content" role="tabpanel" aria-labelledby="payment-1-tab">
                                            <div class="row">
                                                <p>Tab1</p>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="payment-2-content" role="tabpanel" aria-labelledby="payment-2-tab">
                                            <div class="row">
                                                <p>Tab2</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="ps-checkout__order">
                            <h3 class="ps-checkout__heading">Sipariş Toplamı</h3>
                            <div class="ps-checkout__row">
                                <div class="ps-title">Ara Toplam</div>
                                <div class="ps-product__price">{{ currencyPosition($subtotal) }}</div>
                            </div>
                            <div class="ps-checkout__row">
                                <div class="ps-title">Teslimat Ücreti</div>
                                <div class="ps-product__price" id="delivery_fee">Teslimat Adresi Seçiniz</div>
                            </div>
                            <div class="ps-checkout__row">
                                <div class="ps-title">İndirim</div>
                                <div class="ps-product__price">{{ currencyPosition($discount) }}</div>
                            </div>
                            <div class="ps-checkout__row">
                                <div class="ps-title">Toplam</div>
                                <div class="ps-product__price" id="grand_total">{{ currencyPosition($grandTotal) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popupLanguage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered ps-popup--select">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="wrap-modal-slider container-fluid">
                        <button class="close ps-popup__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="ps-popup__body">
                            <div class="ps-checkout">
                                <form action="{{ route('address.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="ps-checkout__heading">Teslimat Adresi</h3>
                                            <div class="ps-checkout__group">
                                                <label for="select-area" class="ps-checkout__label">Şehir/Bölge Seçiniz *</label>
                                                <select class="ps-input" name="area" id="select-area">
                                                    <option value="">Şehir/Bölge Seç</option>
                                                        <option value="">Deneme</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Adınız *</label>
                                                <input class="ps-input" name="first_name" type="text" value="{{ old('first_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Soyadınız *</label>
                                                <input class="ps-input" name="last_name" type="text" value="{{ old('last_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Telefon Numarası *</label>
                                                <input class="ps-input" name="phone" type="text" value="{{ old('phone') }}">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">E-Posta Adresi *</label>
                                                <input class="ps-input" name="email" type="text" value="{{ old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="ps-checkout__group">
                                                <label class="ps-checkout__label">Teslimat Adresiniz</label>
                                                <textarea class="ps-textarea" name="address" rows="3" placeholder="Teslimat Adresinizi Giriniz">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-40">
                                            <div class="row">
                                                <div class="col-6 col-md-2">
                                                    <div class="form-check type-check-column type-check-popup">
                                                        <input class="form-check-input" type="radio" name="type" id="type-home-modal" value="home">
                                                        <label class="form-check-label" for="type-home-modal"><i class="fa fa-home" aria-hidden="true"></i> Ev</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="form-check type-check-column type-check-popup">
                                                        <input class="form-check-input" type="radio" name="type" id="type-office-modal" value="office">
                                                        <label class="form-check-label" for="type-office-modal"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-form__submit">
                                            <button type="submit" class="address-submit-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adres Ekle</button>
                                            <a href="javascript:void(0);" class="address-cancel-btn" data-dismiss="modal" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-back" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M9 11l-4 4l4 4m-4 -4h11a4 4 0 0 0 0 -8h-1" />
                                                </svg> İptal</a>
                                        </div>
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
