@extends('frontend.layouts.master')
@section('content')
@push('css')
<style>
    .ps-coupon__text{
        padding: 5px 36px !important;
        background-color: #b7d7ca !important;
        border-radius: 18px !important;
        font-size: 14px !important;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .ps-shopping__link p{
        margin: 0 !important;
    }
    .ps-coupon-remove{
        padding-left: 15px;
    }
</style>
@endpush
<div class="loader-full-page"></div>
<div class="ps-shopping">
    <div class="container">
        <ul class="ps-breadcrumb">
            <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
            <li class="ps-breadcrumb__item active" aria-current="page">Alışveriş Sepeti</li>
        </ul>
        <h3 class="ps-shopping__title">Alışveriş Sepeti<sup>@if(count(Cart::content()) > 0) ({{ count(Cart::content()) }}) @endif</sup></h3>
        <div class="ps-shopping__content">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-9">

                    <div class="ps-shopping__table">
                        <table class="table ps-table ps-table--product">
                            <thead>
                            <tr>
                                <th class="ps-product__remove"></th>
                                <th class="ps-product__thumbnail"></th>
                                <th class="ps-product__name">Ürün Adı</th>
                                <th class="ps-product__meta">Birim fiyat</th>
                                <th class="ps-product__quantity">Adet</th>
                                <th class="ps-product__subtotal">Ara Toplam</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(Cart::content() as $product)
                                <tr>
                                    <td class="ps-product__remove">
                                        <a href="#" class="remove-cart-product cart-loader-btn-{{ $product->rowId }}" data-id="{{ $product->rowId }}"><i class="icon-cross"></i></a>
                                    </td>
                                    <td class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('product.show', $product->options->product_info['slug']) }}">
                                            <figure><img src="{{ asset($product->options->product_info['image']) }}" alt="{!! $product->name !!}"></figure>
                                        </a></td>
                                    <td class="ps-product__name">
                                        <a href="{{ route('product.show', $product->options->product_info['slug']) }}">{!! $product->name !!}</a>
                                        @if(!empty($product->options['product_size']))
                                            <p class="cart-text cart-page-size">{{ @$product->options['product_size']['name'] }} {{ @$product->options['product_size']['price'] ? '('.currencyPosition(@$product->options['product_size']['price']).')' : '' }}</p>
                                        @endif
                                        @if(!empty($product->options['product_options']))
                                            <ul class="ps-cart__items">
                                                @foreach($product->options->product_options as $cartProductOption)
                                                    <li class="cart-list-item">{{ $cartProductOption['name'] }} {{ $cartProductOption['price'] ? '('.currencyPosition($cartProductOption['price']).')' : '' }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="ps-product__meta">
                                        <span class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                    </td>
                                    <td class="ps-product__quantity">
                                        <div class="def-number-input number-input safari_only">
                                            <button class="minus decrement"><i class="icon-minus"></i></button>
                                            <input class="quantity" min="0" data-id="{{ $product->rowId }}" name="quantity" value="{{ $product->qty }}" type="number" readonly>
                                            <button class="plus increment "><i class="icon-plus"></i></button>
                                        </div>
                                    </td>
                                    <td class="ps-product__subtotal product-cart-total">{{ currencyPosition(productTotal($product->rowId)) }}</td>
                                </tr>
                            @endforeach
                            @if(Cart::content()->count() === 0)
                                <tr>
                                    <td colspan="6" class="text-center"><p>Sepetinizde Ürün Bulunmuyor</p></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    @if(Cart::content()->count() > 0)
                        <form id="coupon_form">
                        <div class="ps-shopping__footer">
                                <div class="ps-shopping__coupon">
                                    <input class="form-control ps-input" id="coupon_code" name="code" type="text" placeholder="Kupon Kodu">
                                    <button class="ps-btn ps-btn--primary" type="submit">Kuponu Onayla</button>
                                </div>
                            <div class="ps-shopping__button">
                                <a href="{{ route('cart.destroy') }}" class="ps-btn ps-btn--primary" type="button">Tümünü Kaldır</a>
                            </div>
                        </div>
                        </form>

                    @endif
                </div>
                <div class="col-12 col-md-5 col-lg-3">
                    <div class="ps-shopping__label">Sepet Toplamı</div>
                    <div class="ps-shopping__box">
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">Ara Toplam</div>
                            <div class="ps-shopping__price" id="subtotal">{{ currencyPosition(cartTotal()) }}</div>
                        </div>
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">İndirim</div>
                            <div class="ps-shopping__price" id="discount">
                                @if(isset(session()->get('coupon')['discount']))
                                    {{ currencyPosition(session()->get('coupon')['discount']) }}
                                @else
                                    {{ currencyPosition(0) }}
                                @endif
                                </div>
                        </div>
                        <div class="ps-shopping__label">Shipping</div>
                        <div class="ps-shopping__checkbox">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cart-free-ship" checked>
                                <label class="form-check-label" for="cart-free-ship">Free shipping</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="cart-ship">
                                <label class="form-check-label" for="cart-ship">Local Pickup: $10.00</label>
                            </div>
                        </div>
                        <div class="ps-shopping__text">Shipping options will be updated during checkout.</div><a class="ps-shopping__toggle" href="#">Calculate shipping</a>
                        <div class="ps-shopping__form">
                            <div class="ps-shopping__group">
                                <select class="js-example-basic-single" name="state">
                                    <option selected>Select a country / region…</option>
                                    <option>Afghanistan</option>
                                    <option>Åland Islands</option>
                                    <option>Albania</option>
                                    <option>Andorra</option>
                                    <option>American Samoa</option>
                                    <option>Andorra</option>
                                </select>
                            </div>
                            <div class="ps-shopping__group">
                                <input class="form-control ps-input" type="text" placeholder="County">
                            </div>
                            <div class="ps-shopping__group">
                                <input class="form-control ps-input" type="text" placeholder="Town / City">
                            </div>
                            <div class="ps-shopping__group">
                                <input class="form-control ps-input" type="text" placeholder="Postcode">
                            </div>
                        </div>
                        <div class="ps-shopping__row">
                            <div class="ps-shopping__label">Toplam</div>
                            <div class="ps-shopping__price" id="final_total">
                                @if(isset(session()->get('coupon')['discount']))
                                    {{ currencyPosition(number_format(cartTotal() - session()->get('coupon')['discount'], 2)) }}
                                @else
                                   {{ currencyPosition(number_format(cartTotal(), 2)) }}
                                @endif
                            </div>
                        </div>
                        <div class="ps-shopping__checkout"><a class="ps-btn ps-btn--warning" href="{{ route('checkout.index') }}">Alışverişi Tamamla</a>
                            <div class="coupon-card">
                                @if(session()->has('coupon'))
                                    <div class="ps-shopping__link">
                                        <p>Kupon Kodu</p>
                                        <div class="ps-coupon__text"> {{ session()->get('coupon')['code'] }} <a href="javascript:void(0);" class="ps-coupon-remove" id="destroy_coupon"><i class="icon-cross"></i></a></div>
                                    </div>
                                @endif
                            </div>
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
            let cartTotal = parseInt("{{ cartTotal() }}");
            $('.increment').on('click', function (){
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data('id');
                inputField.val(currentValue + 1);
                cartQtyUpdate(rowId, inputField.val(), function (response){
                    if(response.status === 'success'){
                        inputField.val(response.qty);
                        let productTotal = response.product_total;
                        setTimeout(() => {
                            inputField.closest('tr').find('.product-cart-total').text('{{ currencyPosition(":productTotal") }}'.replace(":productTotal", productTotal));
                            // Cart Total
                            let cartTotal = response.cart_total;
                            $('#subtotal').text("{{ config('settings.site_currency_icon') }}" + cartTotal);
                            $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response.grand_cart_total)
                        }, 1000);
                    }else if(response.status === 'error'){
                        inputField.val(response.qty);
                        toastr.error(response.message);
                    }
                })
            });
            $('.decrement').on('click', function (){
                let inputField = $(this).siblings('.quantity');
                let currentValue = parseInt(inputField.val());
                let rowId = inputField.data('id');
                if(inputField.val() > 1){
                    inputField.val(currentValue - 1);
                    cartQtyUpdate(rowId, inputField.val(), function (response){
                        if(response.status === 'success'){
                            inputField.val(response.qty);
                            let productTotal = response.product_total;
                            // Cart Total
                            setTimeout(() => {
                                inputField.closest('tr').find('.product-cart-total').text('{{ currencyPosition(":productTotal") }}'.replace(":productTotal", productTotal));
                                let cartTotal = response.cart_total;
                                $('#subtotal').text("{{ config('settings.site_currency_icon') }}" + cartTotal);
                                $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response.grand_cart_total)
                            }, 1000);
                        }else if(response.status === 'error'){
                            inputField.val(response.qty);
                            toastr.error(response.message);
                        }
                    })
                }
            });

            function cartQtyUpdate(rowId, qty, callback) {
                $.ajax({
                    method: 'POST',
                    url: '{{ route("cart.quantity-update") }}',
                    data: {
                        'rowId': rowId,
                        'qty': qty
                    },
                    beforeSend: function () {
                        $('.cart-loader-btn-' + rowId).attr('disabled', true).html('<span class="loader-remove"></span>')
                    },
                    success: function (response) {
                        if(callback && typeof callback === 'function'){
                            callback(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage)
                    },
                    complete: function () {
                        setTimeout(() => {
                            $('.cart-loader-btn-' + rowId).html('<i class="icon-cross"></i>').attr('disabled', false);
                        }, 1000);
                    }
                });
            }

            $('.remove-cart-product').on('click', function (e){
                e.preventDefault();
                let rowId = $(this).data('id');
                removeCartProduct(rowId);
                setTimeout(() => {
                    $(this).closest('tr').remove();
                }, 1000);

            })

            function removeCartProduct(rowId){
                $.ajax({
                    method: 'GET',
                    url: '{{ route("cart-product-remove", ":rowId") }}'.replace(":rowId", rowId),
                    beforeSend: function () {
                        $('.cart-loader-btn-' + rowId).attr('disabled', true).html('<span class="loader-remove"></span>');
                    },
                    success: function (response) {
                        updateSidebarCart();
                        // Cart Total
                        setTimeout(() => {
                            let cartTotal = response.cart_total;
                            $('#subtotal').text("{{ config('settings.site_currency_icon') }}" + cartTotal);
                            $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response.grand_cart_total)
                        }, 1000);

                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage)
                    },
                    complete: function () {
                        setTimeout(() => {
                            $('.cart-loader-btn-' + rowId).html('<i class="icon-cross"></i>').attr('disabled', false);
                        }, 1000);
                    }
                });
            }

            $('#coupon_form').on('submit', function (e){
                e.preventDefault();
                let code = $('#coupon_code').val();
                let subtotal = cartTotal;
                couponApply(code, subtotal);

            })

            function couponApply(code, subtotal){
                $.ajax({
                    method: 'POST',
                    url: '{{ route('apply-coupon') }}',
                    data: {
                        code: code,
                        subtotal: subtotal
                    },
                    beforeSend: function (){
                        $('.loader-full-page').attr('disabled', true).html('<span class="loader-full-size"></span>');
                        $(".ps-shopping").css("opacity", '0.2');
                    },
                    success: function (response){
                        setTimeout(() => {
                        $('#discount').text("{{ config('settings.site_currency_icon') }}" + response.discount);
                        $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response.finalTotal);
                        let couponCartHtml = `<div class="ps-shopping__link">
                                    <p>Kupon Kodu</p>
                                    <div class="ps-coupon__text">${response.coupon_code}<a href="javascript:void(0);" class="ps-coupon-remove" id="destroy_coupon"><i class="icon-cross"></i></a></div>
                                    </div>`;
                        $('.coupon-card').html(couponCartHtml);

                            $('#coupon_code').val("");
                            toastr.success(response.message);
                        }, 1000);

                    },
                    error: function (xhr, status, error){
                        setTimeout(() => {
                            let errorMessage = xhr.responseJSON.message;
                            toastr.error(errorMessage)
                        }, 1000);

                    },
                    complete: function (){
                        setTimeout(() => {
                            $('.loader-full-size').remove();
                            $(".ps-shopping").css("opacity", '1');
                        }, 1000);
                    }
                })
            }

            $(document).on('click', '#destroy_coupon', function (){
                destroyCoupon();
            })

            function destroyCoupon(){
                $.ajax({
                    method: 'GET',
                    url: '{{ route("destroy-coupon") }}',
                    beforeSend: function(){
                        $('.loader-full-page').attr('disabled', true).html('<span class="loader-full-size"></span>');
                        $(".ps-shopping").css("opacity", '0.2');
                    },
                    success: function(response){
                        setTimeout(() => {
                            $('#discount').text("{{ config('settings.site_currency_icon') }}" + 0)
                            $('#final_total').text("{{ config('settings.site_currency_icon') }}" + response.grand_cart_total);
                            $('.coupon-card').html("");
                            $('#coupon_code').val("");
                            toastr.success(response.message);
                        }, 1000);
                    },
                    error: function(xhr, status, error){
                        setTimeout(() => {
                            let errorMessage = xhr.responseJSON.message;
                            toastr.error(errorMessage)
                        }, 1000);
                    },
                    complete: function(){
                        setTimeout(() => {
                            $('.loader-full-size').remove();
                            $(".ps-shopping").css("opacity", '1');
                        }, 1000);
                    }
                })
            }

        })
    </script>
@endpush
