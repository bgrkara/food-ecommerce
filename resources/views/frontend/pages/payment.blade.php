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
        .paypal_content p {
            color: #103178 !important;
            font-size: 17px !important;
            text-align: center !important;
        }
        .stripe_content p {
            color: #103178 !important;
            font-size: 17px !important;
            text-align: center !important;
        }
        .iyzico_content p {
            color: #103178 !important;
            font-size: 17px !important;
            text-align: center !important;
        }
        #payment-paypal-content img{
            max-width: 225px;
        }
        .ps-shopping__button .ps-btn{ max-width: fit-content; border-radius: 5px 25px 5px 25px !important; background-color: #4854d8 !important; border-color: #4854d8 !important;}
        .ps-shopping__button .ps-btn:hover{ color: #4854d8 !important; border-radius: 25px 5px 25px 5px !important; background-color: #FFFFFF !important; border-color: #4854d8 !important;}
        .ps-shopping__button{ display: flex; justify-content: center;}
        #payment-stripe-content img { max-width: 225px;}
        #payment-iyzico-content img { max-width: 225px;}
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
            <h3 class="ps-checkout__title"><span class="complete_order_icon">&#128179;</span> Ödeme İşlemi</h3>
            <div class="ps-checkout__content">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="ps-payment">
                            <div class="ps-payment__content">
                                <div class="ps-payment__tabs">
                                    <ul class="nav nav-tabs" id="productContentTabs" role="tablist">
                                        @if(config('gatewaySettings.paypal_status'))
                                            <li class="nav-item payment-icon" role="presentation"><a class="nav-link" id="payment-paypal-tab" data-toggle="tab" href="#payment-paypal-content" role="tab" aria-controls="payment-paypal-content" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="120" height="52" viewBox="0 0 338.667 66.785"><g transform="translate(936.898 -21.779)"><path clip-path="none" d="M-828.604 39.734c-.697 0-1.289.506-1.398 1.195l-8.068 51.165a1.31 1.31 0 0 0 1.294 1.513h9.568c.696 0 1.289-.507 1.398-1.195l2.37-15.025c.108-.688.701-1.195 1.398-1.195h8.699c10.164 0 18.792-7.416 20.368-17.465 1.589-10.134-6.328-18.971-17.549-18.993zm9.301 11.422h6.96c5.73 0 7.596 3.381 7.006 7.12-.59 3.747-3.488 6.507-9.031 6.507h-7.084zm45.788 3.478c-2.416.009-5.196.504-8.317 1.804-7.159 2.984-10.597 9.151-12.057 13.647 0 0-4.647 13.717 5.852 21.253 0 0 9.737 7.255 20.698-.447l-.189 1.203a1.31 1.31 0 0 0 1.292 1.513h9.083c.697 0 1.289-.507 1.398-1.195l5.525-35.038a1.31 1.31 0 0 0-1.292-1.515h-9.083c-.697 0-1.29.507-1.398 1.195l-.297 1.886s-3.967-4.333-11.216-4.306zm.297 11.067c1.043 0 1.997.144 2.853.419 3.919 1.258 6.141 5.023 5.498 9.104-.793 5.025-4.914 8.725-10.199 8.725-1.042 0-1.996-.143-2.853-.418-3.918-1.258-6.154-5.023-5.511-9.104.793-5.025 4.927-8.727 10.212-8.727z" fill="#003087"/><path clip-path="none" d="M-697.804 39.734c-.697 0-1.289.506-1.398 1.195l-8.068 51.165a1.31 1.31 0 0 0 1.294 1.513h9.568c.696 0 1.289-.507 1.398-1.195l2.37-15.025c.108-.688.701-1.195 1.398-1.195h8.699c10.164 0 18.791-7.416 20.366-17.465 1.59-10.134-6.326-18.971-17.547-18.993zm9.301 11.422h6.96c5.73 0 7.596 3.381 7.006 7.12-.59 3.747-3.487 6.507-9.031 6.507h-7.084zm45.787 3.478c-2.416.009-5.196.504-8.317 1.804-7.159 2.984-10.597 9.151-12.057 13.647 0 0-4.645 13.717 5.854 21.253 0 0 9.735 7.255 20.697-.447l-.189 1.203a1.31 1.31 0 0 0 1.294 1.513h9.082c.697 0 1.289-.507 1.398-1.195l5.527-35.038a1.31 1.31 0 0 0-1.294-1.515h-9.083c-.697 0-1.29.507-1.398 1.195l-.297 1.886s-3.967-4.333-11.216-4.306zm.297 11.067c1.043 0 1.997.144 2.853.419 3.919 1.258 6.141 5.023 5.498 9.104-.793 5.025-4.914 8.725-10.199 8.725-1.042 0-1.996-.143-2.853-.418-3.918-1.258-6.154-5.023-5.511-9.104.793-5.025 4.927-8.727 10.212-8.727z" fill="#0070e0"/><path clip-path="none" d="M-745.92 55.859c-.72 0-1.232.703-1.012 1.388l9.958 30.901-9.004 14.562c-.437.707.071 1.62.902 1.62h10.642a1.77 1.77 0 0 0 1.513-.854l27.811-46.007c.427-.707-.083-1.611-.909-1.611h-10.641a1.77 1.77 0 0 0-1.522.869l-10.947 18.482-5.557-18.345c-.181-.597-.732-1.006-1.355-1.006z" fill="#003087"/><path clip-path="none" d="M-609.107 39.734c-.696 0-1.289.507-1.398 1.195l-8.07 51.163a1.31 1.31 0 0 0 1.294 1.515h9.568c.696 0 1.289-.507 1.398-1.195l8.068-51.165a1.31 1.31 0 0 0-1.292-1.513z" fill="#0070e0"/><path clip-path="none" d="M-908.37 39.734a2.59 2.59 0 0 0-2.556 2.185l-4.247 26.936c.198-1.258 1.282-2.185 2.556-2.185h12.445c12.525 0 23.153-9.137 25.095-21.519a20.76 20.76 0 0 0 .245-2.793c-3.183-1.669-6.922-2.624-11.019-2.624z" fill="#001c64"/><path clip-path="none" d="M-874.832 42.359a20.76 20.76 0 0 1-.245 2.793c-1.942 12.382-12.571 21.519-25.095 21.519h-12.445c-1.273 0-2.358.926-2.556 2.185l-3.905 24.752-2.446 15.528a2.1 2.1 0 0 0 2.075 2.43h13.508a2.59 2.59 0 0 0 2.556-2.185l3.558-22.567a2.59 2.59 0 0 1 2.558-2.185h7.953c12.525 0 23.153-9.137 25.095-21.519 1.379-8.788-3.047-16.784-10.611-20.75z" fill="#0070e0"/><path clip-path="none" d="M-923.716 21.779c-1.273 0-2.358.926-2.556 2.183l-10.6 67.216c-.201 1.276.785 2.43 2.077 2.43h15.719l3.903-24.752 4.247-26.936a2.59 2.59 0 0 1 2.556-2.185h22.519c4.098 0 7.836.956 11.019 2.624.218-11.273-9.084-20.58-21.873-20.58z" fill="#003087"/></g></svg></a></li>
                                        @endif
                                        @if(config('gatewaySettings.stripe_status'))
                                                <li class="nav-item payment-icon" role="presentation"><a class="nav-link" id="payment-stripe-tab" data-toggle="tab" href="#payment-stripe-content" role="tab" aria-controls="payment-stripe-content" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="120" height="52" viewBox="0 0 120 52" fill-rule="evenodd" fill="#6772e5"><path d="M101.547 30.94c0-5.885-2.85-10.53-8.3-10.53-5.47 0-8.782 4.644-8.782 10.483 0 6.92 3.908 10.414 9.517 10.414 2.736 0 4.805-.62 6.368-1.494v-4.598c-1.563.782-3.356 1.264-5.632 1.264-2.23 0-4.207-.782-4.46-3.494h11.24c0-.3.046-1.494.046-2.046zM90.2 28.757c0-2.598 1.586-3.678 3.035-3.678 1.402 0 2.897 1.08 2.897 3.678zm-14.597-8.345c-2.253 0-3.7 1.057-4.506 1.793l-.3-1.425H65.73v26.805l5.747-1.218.023-6.506c.828.598 2.046 1.448 4.07 1.448 4.115 0 7.862-3.3 7.862-10.598-.023-6.667-3.816-10.3-7.84-10.3zm-1.38 15.84c-1.356 0-2.16-.483-2.713-1.08l-.023-8.53c.598-.667 1.425-1.126 2.736-1.126 2.092 0 3.54 2.345 3.54 5.356 0 3.08-1.425 5.38-3.54 5.38zm-16.4-17.196l5.77-1.24V13.15l-5.77 1.218zm0 1.747h5.77v20.115h-5.77zm-6.185 1.7l-.368-1.7h-4.966V40.92h5.747V27.286c1.356-1.77 3.655-1.448 4.368-1.195v-5.287c-.736-.276-3.425-.782-4.782 1.7zm-11.494-6.7L34.535 17l-.023 18.414c0 3.402 2.552 5.908 5.954 5.908 1.885 0 3.264-.345 4.023-.76v-4.667c-.736.3-4.368 1.356-4.368-2.046V25.7h4.368v-4.897h-4.37zm-15.54 10.828c0-.897.736-1.24 1.954-1.24a12.85 12.85 0 0 1 5.7 1.47V21.47c-1.908-.76-3.793-1.057-5.7-1.057-4.667 0-7.77 2.437-7.77 6.506 0 6.345 8.736 5.333 8.736 8.07 0 1.057-.92 1.402-2.207 1.402-1.908 0-4.345-.782-6.276-1.84v5.47c2.138.92 4.3 1.3 6.276 1.3 4.782 0 8.07-2.368 8.07-6.483-.023-6.85-8.782-5.632-8.782-8.207z"/></svg></a></li>
                                        @endif
                                        @if(config('gatewaySettings.iyzico_status'))
                                                <li class="nav-item payment-icon" role="presentation"><a class="nav-link" id="payment-iyzico-tab" data-toggle="tab" href="#payment-iyzico-content" role="tab" aria-controls="payment-iyzico-content" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="120" height="53" viewBox="0 -32 180 108">
                                                            <defs>
                                                                <path id="uwtj7m37aa" d="M0 0.07L10.176 0.07 10.176 10.188 0 10.188z"/>
                                                                <path id="gm7ejcreqc" d="M0.215 0.07L10.398 0.07 10.398 10.188 0.215 10.188z"/>
                                                            </defs>
                                                            <g fill="none" fill-rule="evenodd">
                                                                <path fill="#1E64FF" d="M5.087 14.81C2.543 14.81.48 16.86.48 19.382v26.773c0 2.531 2.062 4.576 4.606 4.576 2.542 0 4.605-2.045 4.605-4.576V19.382c0-2.523-2.063-4.572-4.605-4.572" transform="translate(0 .914)"/>
                                                                <g transform="translate(0 .914) translate(0 .162)">
                                                                    <mask id="6r16igxdyb" fill="#fff">
                                                                        <use xlink:href="#uwtj7m37aa"/>
                                                                    </mask>
                                                                    <path fill="#1E64FF" d="M5.087.07C2.277.07 0 2.335 0 5.13c0 2.789 2.278 5.058 5.087 5.058 2.808 0 5.089-2.27 5.089-5.058 0-2.795-2.281-5.06-5.09-5.06" mask="url(#6r16igxdyb)"/>
                                                                </g>
                                                                <path fill="#1E64FF" d="M87.526 46.155c0-2.524-2.064-4.58-4.611-4.58H70.194l16.258-19.25c1.631-1.935 1.377-4.827-.57-6.444-.907-.76-2.018-1.109-3.119-1.071-.051-.006-20.343 0-20.343 0-2.546 0-4.606 2.05-4.606 4.571 0 2.531 2.06 4.587 4.606 4.587h10.626L56.792 43.213c-1.637 1.94-1.38 4.825.566 6.446.863.726 1.916 1.072 2.962 1.072h22.595c2.547 0 4.611-2.045 4.611-4.576M128.12 23.358c2.523 0 4.887.972 6.672 2.748 1.798 1.783 4.715 1.783 6.516 0 1.792-1.79 1.792-4.688 0-6.476-3.524-3.504-8.208-5.431-13.189-5.431-4.975 0-9.657 1.927-13.177 5.43-3.522 3.503-5.463 8.15-5.463 13.102 0 4.948 1.94 9.605 5.463 13.098 3.52 3.503 8.202 5.435 13.177 5.435 4.981 0 9.665-1.932 13.19-5.435 1.791-1.781 1.791-4.68 0-6.468-1.802-1.792-4.72-1.792-6.517 0-1.785 1.764-4.149 2.75-6.673 2.75-2.517 0-4.885-.986-6.664-2.75-1.783-1.773-2.763-4.126-2.763-6.63 0-2.504.98-4.862 2.763-6.625 1.78-1.776 4.147-2.748 6.664-2.748M165.356 42.111c-5.197 0-9.424-4.21-9.424-9.38 0-5.17 4.227-9.373 9.424-9.373 5.202 0 9.435 4.203 9.435 9.373 0 5.17-4.233 9.38-9.435 9.38m0-27.912c-10.275 0-18.638 8.313-18.638 18.532 0 10.218 8.363 18.533 18.638 18.533 10.28 0 18.644-8.315 18.644-18.533 0-10.22-8.363-18.532-18.644-18.532M98.839 14.81c-2.54 0-4.6 2.05-4.6 4.572v26.773c0 2.531 2.06 4.576 4.6 4.576 2.548 0 4.606-2.045 4.606-4.576V19.382c0-2.523-2.058-4.572-4.606-4.572" transform="translate(0 .914)"/>
                                                                <g transform="translate(0 .914) translate(93.533 .162)">
                                                                    <mask id="63pm8sc9gd" fill="#fff">
                                                                        <use xlink:href="#gm7ejcreqc"/>
                                                                    </mask>
                                                                    <path fill="#1E64FF" d="M5.305.07C2.495.07.215 2.335.215 5.13c0 2.789 2.28 5.058 5.09 5.058 2.815 0 5.093-2.27 5.093-5.058 0-2.795-2.278-5.06-5.093-5.06" mask="url(#63pm8sc9gd)"/>
                                                                </g>
                                                                <path fill="#1E64FF" d="M49.812 15.325c-2.259-1.167-5.037-.293-6.21 1.948l-9.879 18.93-9.88-18.93c-1.17-2.24-3.953-3.115-6.21-1.948-2.255 1.169-3.136 3.933-1.963 6.178l12.861 24.644-5.938 11.4c-1.174 2.245-.299 5.01 1.96 6.174.741.39 1.54.55 2.322.512 1.59-.066 3.105-.951 3.895-2.457l21-40.273c1.177-2.245.3-5.01-1.958-6.178" transform="translate(0 .914)"/></g></svg></a></li>
                                        @endif
                                    </ul>
                                    <div class="tab-content" id="productContent">
                                        <div class="tab-pane fade show" id="payment-paypal-content" role="tabpanel" aria-labelledby="payment-paypal-tab">
                                            <div class="row justify-content-center">
                                                 <div class="mt-40">
                                                     <img src="{{ asset('frontend/img/icon/paypal-logo.png') }}" alt="">
                                                 </div>
                                                <div class="paypal_content mt-30">
                                                    <p>Öde Butonuna Bastığınızda Ödeme İşlemini Tamamlamak İçin Sizi PayPal'ın güvenli ödeme sayfasına yönlendirecektir.</p>
                                                    <p>İşlemin Sorunsuz Bir Biçimde Tamamlanabilmesi İçin Lütfen Sayfası Kapatmayınız!</p>
                                                    <div class="ps-shopping__button">
                                                        <a href="#" class="ps-btn ps-btn--primary payment-card" data-name="paypal" type="button">{{ currencyPosition($grandTotal) }} Öde</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="payment-stripe-content" role="tabpanel" aria-labelledby="payment-stripe-tab">
                                            <div class="row">
                                                <div class="row justify-content-center">
                                                    <div class="mt-40">
                                                        <img src="{{ asset('frontend/img/icon/stripe-logo.png') }}" alt="">
                                                    </div>
                                                    <div class="stripe_content mt-30">
                                                        <p>Öde Butonuna Bastığınızda Ödeme İşlemini Tamamlamak İçin Sizi Stripe'ın güvenli ödeme sayfasına yönlendirecektir.</p>
                                                        <p>İşlemin Sorunsuz Bir Biçimde Tamamlanabilmesi İçin Lütfen Sayfası Kapatmayınız!</p>
                                                        <div class="ps-shopping__button">
                                                            <a href="#" class="ps-btn ps-btn--primary payment-card" data-name="stripe" type="button">{{ currencyPosition($grandTotal) }} Öde</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade show" id="payment-iyzico-content" role="tabpanel" aria-labelledby="payment-iyzico-tab">
                                            <div class="row justify-content-center">
                                                <div class="iyzico_content mt-30">
                                                    <div id="iyzipay-checkout-form" class="responsive">{!! $paymentInput !!}</div>
                                                </div>
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
                                <div class="ps-product__price" id="delivery_fee">{{ currencyPosition($delivery) }}</div>
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
@push('scripts')
    <script>
        $(document).ready(function (){
            $('.payment-card').on('click', function (e){
                e.preventDefault();
                let paymentGateway = $(this).data('name');
                $.ajax({
                    method: 'POST',
                    url: '{{ route('make-payment') }}',
                    data: {
                        payment_gateway : paymentGateway,
                    },
                    beforeSend: function (){
                        $('.loader-full-page').attr('disabled', true).html('<span class="loader-full-size"></span>');
                        $(".ps-checkout__main").css("opacity", '0.2');
                    },
                    success: function (response){
                        window.location.href = response.redirect_url;
                    },
                    error: function (xhr, status, error){
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage);
                    },
                    complete: function (){
                        setTimeout(() => {
                            $('.loader-full-size').remove();
                            $(".ps-checkout__main").css("opacity", '1');
                        }, 3000);
                    }
                })
            });

            /** Payment List First **/
            let productTabs = $('#productContentTabs').find('li:first').find('a');
            productTabs.click();
        })
    </script>
@endpush
