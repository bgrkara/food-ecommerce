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
    </style>
@endpush
@section('content')
    <div class="loader-full-page"></div>
    <div class="ps-checkout ps-checkout__main">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page"> Ödeme</li>
            </ul>
            <h3 class="ps-checkout__title"><span class="complete_order_icon">&#128179;</span> Siparişi Tamamla</h3>
            <div class="ps-checkout__content">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            @if($userAddresses->count())
                                <div class="d-flex justify-content-end">
                                    <div class="col-3">
                                        <button class="ps-btn-address-add ps-btn--warning"  data-toggle="modal" data-target="#popupLanguage"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 5l0 14" />
                                                <path d="M5 12l14 0" />
                                            </svg> Adres Ekle</button>
                                    </div>
                                </div>
                                <div class="ps-checkout mb-40">
                                    <div class="row">
                                        @foreach($userAddresses as $address)
                                            <div class="col-md-6 dash-order address-list dash-bg-white">
                                                <div class="address-content v_address" data-address="address_content_{{ $address->id }}">
                                                    <div class="row title-head m-4">
                                                        <div class="head-column form-check type-check-column">
                                                            <input class="form-check-input head-location" type="radio" name="type" id="home_update_{{ $address->id }}" value="{{ $address->id }}">
                                                            <label class="form-check-label" for="home_update_{{ $address->id }}">
                                                                @if($address->type === 'home')
                                                                    <span class="delivery-type"><i class="fa fa-home" aria-hidden="true"></i> Ev</span>
                                                                @else
                                                                    <span class="delivery-type"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</span>
                                                                @endif
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="ps-section--address mt-4">
                                                        <div class="ps-address-item">
                                                            <div class="ps-address__row">
                                                                <p>TESLİMAT ADRESİ </p>
                                                                <div class="ps-product__name">{{ $address->address }} - {{ $address->deliveryArea?->area_name }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="ps-checkout__form">
                                    <h3 class="ps-checkout__heading">Teslimat Adresi</h3>
                                    <form action="{{ route('address.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="ps-checkout__group">
                                                <label for="select-area" class="ps-checkout__label">Şehir/Bölge Seçiniz *</label>
                                                <select class="ps-input" name="area" id="select-area">
                                                    <option value="">Şehir/Bölge Seç</option>
                                                    @foreach($deliveryAreas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                    @endforeach
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
                                                        <input class="form-check-input" type="radio" name="type" id="type-home" value="home">
                                                        <label class="form-check-label" for="type-home"><i class="fa fa-home" aria-hidden="true"></i> Ev</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-2">
                                                    <div class="form-check type-check-column type-check-popup">
                                                        <input class="form-check-input" type="radio" name="type" id="type-office" value="office">
                                                        <label class="form-check-label" for="type-office"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps-form__submit">
                                            <button type="submit" class="address-submit-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adres Ekle</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="ps-checkout__order">
                                <h3 class="ps-checkout__heading">Sipariş Toplamı</h3>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Ara Toplam</div>
                                    <div class="ps-product__price">{{ currencyPosition(cartTotal()) }}</div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Teslimat Ücreti</div>
                                    <div class="ps-product__price" id="delivery_fee">Teslimat Adresi Seçiniz</div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">İndirim</div>
                                    <div class="ps-product__price">
                                        @if(session()->has('coupon'))
                                            {{ currencyPosition(session()->get('coupon')['discount']) }}
                                        @else
                                            {{ currencyPosition(0) }}
                                        @endif
                                    </div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Toplam</div>
                                    <div class="ps-product__price" id="grand_total">{{ currencyPosition(grandCartTotal()) }}</div>
                                </div>
                                <div class="ps-checkout__payment">
                                    <div class="check-faq">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree-faq" checked>
                                            <label class="form-check-label" for="agree-faq"> Web sitesinin hüküm ve koşullarını okudum ve kabul ediyorum *</label>
                                        </div>
                                    </div>
                                    <button class="ps-btn ps-btn--warning">Siparişi Onayla</button>
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
                                                    @foreach($deliveryAreas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                                    @endforeach
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
@push('scripts')
    <script>
        $(document).ready(function (){
            $('.address-content').on('click', function (){
                let id = $(this).find('input.head-location').attr('id');
                $('#'+id).prop('checked', true);
                $(this).addClass('selected').removeClass('not-selected');
                $('.address-content').not(this).addClass('not-selected').removeClass('selected');
            })

            $('.v_address').on('click', function (){
                let addressId = $(this).find('input.head-location').val();
                let deliveryFee = $('#delivery_fee');
                let grandTotal = $('#grand_total');
                $.ajax({
                    method: 'GET',
                    url: '{{ route("checkout.delivery-cal", ":id") }}'.replace(":id", addressId),
                    beforeSend: function (){
                        $('.loader-full-page').attr('disabled', true).html('<span class="loader-full-size"></span>');
                        $(".ps-checkout__main").css("opacity", '0.2');
                    },
                    success: function (response){
                        deliveryFee.text("{{ currencyPosition(':amount') }}"
                            .replace(":amount", response.delivery_fee));
                        grandTotal.text("{{ currencyPosition(':amount') }}"
                            .replace(":amount", response.grand_total));
                    },
                    error: function (xhr, status, error){
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function (){
                        setTimeout(() => {
                            $('.loader-full-size').remove();
                            $(".ps-checkout__main").css("opacity", '1');
                        }, 500);
                    }
                })
            })
        })
    </script>
@endpush
