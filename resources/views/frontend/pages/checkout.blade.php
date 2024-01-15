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
            min-height: 214px;
            max-height: 214px;
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
            background-color: #FD8D27;
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
        .form-check .form-check-label::after {
            left: 5px !important;
            top: 3px !important;
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
    </style>
@endpush
@section('content')
    <div class="ps-checkout">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page"> Ödeme</li>
            </ul>
            <h3 class="ps-checkout__title"><span class="complete_order_icon">&#128179;</span> Siparişi Tamamla</h3>
            <div class="ps-checkout__content">
                <div class="ps-checkout__wapper">
                    <p class="ps-checkout__text">Returning customer? <a href="#">Click here to login</a></p>
                    <p class="ps-checkout__text">Have a coupon? <a href="#">Click here to enter your code</a></p>
                </div>
                <form action="http://nouthemes.net/html/mymedi/do_action" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <div class="d-flex justify-content-end">
                                <div class="col-3">
                                    <button class="ps-btn-address-add ps-btn--warning"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg> Adres Ekle</button>
                                </div>
                            </div>
                            <div class="ps-checkout">
                                <div class="row">
                                    @foreach($userAddresses as $address)
                                        <div class="col-md-6 dash-order address-list dash-bg-white">
                                            <div class="address-content" data-address="address_content_{{ $address->id }}">
                                                <div class="row title-head m-4">
                                                    <div class="head-column form-check type-check-column">
                                                        <input class="form-check-input head-location" type="radio" name="type" id="home_update_{{ $address->id }}" value="{{ $address->type }}">
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

                            <div class="ps-checkout__form">
                                <h3 class="ps-checkout__heading">Billing details</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Email address *</label>
                                            <input class="ps-input" type="email">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">First name *</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Last name *</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Company name (optional)</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Street address *</label>
                                            <input class="ps-input mb-3" type="text" placeholder="House number and street name">
                                            <input class="ps-input" type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Town / City *</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Postcode *</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">County (optional)</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Phone *</label>
                                            <input class="ps-input" type="text">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="create-account">
                                                <label class="form-check-label" for="create-account">Create an account?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 ps-hidden" data-for="create-account">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label ps-label--danger">Create account password *</label>
                                            <div class="input-group">
                                                <input class="form-control ps-input" type="password" placeholder="Password">
                                                <div class="input-group-append"><a class="fa fa-eye-slash toogle-password" href="javascript: vois(0);"></a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="ship-address">
                                                <label class="form-check-label" for="ship-address">Ship to a different address?</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 ps-hidden" data-for="ship-address">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">First name *</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Last name *</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Company name (optional)</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Street address *</label>
                                                    <input class="ps-input mb-3" type="text" placeholder="House number and street name">
                                                    <input class="ps-input" type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Town / City *</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">Postcode *</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ps-checkout__group">
                                                    <label class="ps-checkout__label">County (optional)</label>
                                                    <input class="ps-input" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="ps-checkout__group">
                                            <label class="ps-checkout__label">Order notes (optional)</label>
                                            <textarea class="ps-textarea" rows="7" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="ps-checkout__order">
                                <h3 class="ps-checkout__heading">Your order</h3>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Product</div>
                                    <div class="ps-title">Subtotal</div>
                                </div>
                                <div class="ps-checkout__row ps-product">
                                    <div class="ps-product__name">Somersung Sonic X2500 Pro White x <span>1</span></div>
                                    <div class="ps-product__price">$399.99</div>
                                </div>
                                <div class="ps-checkout__row ps-product">
                                    <div class="ps-product__name">Digital Thermometer X30-Pro x <span>1</span></div>
                                    <div class="ps-product__price">$77.65</div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Subtotal</div>
                                    <div class="ps-product__price">$814.85</div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Shipping</div>
                                    <div class="ps-checkout__checkbox">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="free-ship" checked>
                                            <label class="form-check-label" for="free-ship">Free shipping</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="price-ship">
                                            <label class="form-check-label" for="price-ship">Local Pickup: <span>$10.00</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-checkout__row">
                                    <div class="ps-title">Total</div>
                                    <div class="ps-product__price">$814.85</div>
                                </div>
                                <div class="ps-checkout__payment">
                                    <div class="payment-method">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="payment" checked>
                                            <label class="form-check-label" for="payment">Check payments</label>
                                        </div>
                                        <p class="ps-note">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                    <div class="paypal-method">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="paypal">
                                            <label class="form-check-label" for="paypal"> PayPal <img src="img/AM_mc_vs_ms_ae_UK.png" alt=""><a href="https://www.paypal.com/uk/webapps/mpp/paypal-popup">What is PayPal?</a></label>
                                        </div>
                                    </div>
                                    <div class="check-faq">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agree-faq" checked>
                                            <label class="form-check-label" for="agree-faq"> I have read and agree to the website terms and conditions *</label>
                                        </div>
                                    </div>
                                    <button class="ps-btn ps-btn--warning">Siparişi Onayla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
        })
    </script>
@endpush
