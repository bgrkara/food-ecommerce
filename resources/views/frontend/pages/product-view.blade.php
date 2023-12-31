@extends('frontend.layouts.master')
@section('content')
    @push('css')
        <style>
            .form-check .form-check-label::before{
                background: #f9a75c !important;
            }
        </style>
    @endpush
    <div class="ps-page--product-variable">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="ps-breadcrumb__item"><a href="#">{{ $product->category->name }}</a></li>
                <li class="ps-breadcrumb__item active" aria-current="page">{{ $product->name }}</li>
            </ul>
            <div class="ps-page__content">
                <div class="ps-product--detail">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <div class="col-12 col-xl-7">
                                    <div class="ps-product--gallery">
                                        <div class="ps-product__thumbnail">
                                            <div class="slide"><img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" /></div>
                                            @foreach($product->productImages as $image)
                                                <div class="slide"><img src="{{ asset($image->image) }}" alt="{{ $product->name }}" /></div>
                                            @endforeach
                                        </div>
                                        <div class="ps-gallery--image">
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" /></div>
                                            </div>
                                            @foreach($product->productImages as $image)
                                                <div class="slide">
                                                    <div class="ps-gallery__item"><img src="{{ asset($image->image) }}" alt="{{ $product->name }}" /></div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-5">
                                    <div class="ps-product__info">
                                        <div class="ps-product__branch"><a href="#">{!! $product->category->name !!}</a></div>
                                        <div class="ps-product__title"><a href="#">{!! $product->name !!}</a></div>
                                        <div class="ps-product__rating">
                                            <select class="ps-rating" data-read-only="true">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4" selected="selected">4</option>
                                                <option value="5">5</option>
                                            </select><span class="ps-product__review">(5 Reviews)</span>
                                        </div>
                                        <div class="ps-product__desc">
                                           {!! $product->short_description !!}
                                        </div>
                                        <ul class="ps-product__bundle">
                                            <li><i class="icon-wallet"></i>%100 Para İadesi</li>
                                            <li><i class="icon-bag2"></i>Temassız Teslimat</li>
                                            <li><i class="icon-truck"></i>{{ currencyPosition(300) }} ve Üzeri Siparişlerde Ücretsiz Teslimat</li>
                                        </ul>
                                        <div class="ps-product__type">
                                            <ul class="ps-product__list">
                                                <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">{{ $product->sku }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-3">

                            <div class="ps-product__feature">
                                <form action="" id="v_add_to_cart_form">
                                    @csrf
                                    <input type="hidden" name="base_price" class="v_base_price"
                                           value="{{ $product->offer_price > 0 ? $product->offer_price : $product->price }}">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    @if($product->quantity < 10 && $product->quantity !== 0)
                                        <div class="ps-product__badge"><span class="ps-badge ps-badge--leftstock">Stokta Son {{ $product->quantity }} Ürün</span>
                                    @elseif($product->quantity === 0)
                                        <div class="ps-product__badge"><span class="ps-badge ps-badge--outstock">Stokta Yok</span>
                                    @else
                                        <div class="ps-product__badge"><span class="ps-badge ps-badge--instock">Stokta Var</span>
                                    @endif

                                </div>
                                <div class="ps-product__meta">
                                    @if($product->offer_price > 0)
                                        <span class="ps-product__price sale">{{ currencyPosition($product->offer_price) }}</span>
                                        <span class="ps-product__del">{{ currencyPosition($product->price) }}</span>
                                    @else
                                        <span class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                    @endif
                                </div>
                                <div class="ps-product__variable">
                                    @if($product->productSizes()->exists())
                                        <div class="ps-product__attribute">
                                            <h6>Boyut (*Zorunlu)</h6>
                                            <select class="form-select v_product_size" name="product_size" required="">
                                                <option value="" data-price="0">Bir Seçenek Seçin</option>
                                                @foreach($product->productSizes as $productSize)
                                                    <option data-price="{{ $productSize->price }}" value="{{ $productSize->id }}">{{ $productSize->name }} + {{ currencyPosition($productSize->price) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if($product->productOptions()->exists())
                                        <div class="ps-product__attribute">
                                            <h6>Ek Seçenekler</h6>
                                            @foreach($product->productOptions as $productOption)
                                                <div class="form-check">
                                                    <input class="form-check-input v_product_option" type="checkbox" name="product_option[]" data-price="{{ $productOption->price }}" value="{{ $productOption->id }}" id="size-{{ $productOption->id }}">
                                                    <label class="form-check-label" for="size-{{ $productOption->id }}">
                                                        {{ $productOption->name }} + {{ currencyPosition($productOption->price) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="ps-product__quantity">
                                    <h6>Adet</h6>
                                    <div class="def-number-input number-input safari_only">
                                        <button class="minus v_decrement"><i class="icon-minus"></i></button>
                                        <input type="number" id="v_quantity" value="1" min="0" name="quantity" placeholder="1" readonly />
                                        <button class="plus v_increment"><i class="icon-plus"></i></button>
                                    </div>
                                </div>
                                <hr>
                                <div class="ps-product__meta product-page-total">
                                    <h6>Ara Toplam: &nbsp;&nbsp;</h6>
                                    @if($product->offer_price > 0)
                                        <span id="v_total_price" class="ps-product__price sale">{{ currencyPosition($product->offer_price) }}</span>
                                    @else
                                        <span id="v_total_price" class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                    @endif
                                </div>
                                </form>
                                @if($product->quantity === 0)
                                    <button class="ps-btn ps-btn--none-stock" type="button" readonly>Stokta Yok</button>
                                @else
                                    <a class="ps-btn ps-btn--warning v_submit_button" href="#">Sepete Ekle</a>
                                @endif
                                <div class="ps-product__variations"><a class="ps-product__link" href="wishlist.html">Add to wishlist</a><a class="ps-product__link" href="compare.html">Add to Compare</a></div>
                            </div>

                        </div>
                    </div>
                    <div class="ps-product__content">
                        <ul class="nav nav-tabs ps-tab-list" id="productContentTabs" role="tablist">
                            <li class="nav-item" role="presentation"><a class="nav-link active" id="description-tab" data-toggle="tab" href="#description-content" role="tab" aria-controls="description-content" aria-selected="true">Description</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews-content" role="tab" aria-controls="reviews-content" aria-selected="false">Reviews (5)</a></li>
                        </ul>
                        <div class="tab-content" id="productContent" style="margin-bottom: 80px;">
                            <div class="tab-pane fade show active" id="description-content" role="tabpanel" aria-labelledby="description-tab">
                                <div class="ps-document">
                                {!! $product->long_description !!}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews-content" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="ps-product__tabreview">
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">Mark J.</div>
                                                <div class="ps-review__date">Oct 30, 2021</div>
                                            </div>
                                            <div class="ps-review__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>Everything is perfect. I would recommend!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review2.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">Ann R.</div>
                                                <div class="ps-review__date">Oct 30, 2021</div>
                                            </div>
                                            <div class="ps-review__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>There was a small mistake in the order. In return, I got the correct order and I could keep the wrong one for myself.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review3.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">Jenna S.</div>
                                                <div class="ps-review__date">Oct 30, 2021</div>
                                            </div>
                                            <div class="ps-review__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>I ordered on Friday evening and on Monday at 12:30 the package was with me. I have never encountered such a fast order processing.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review4.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">John M.</div>
                                                <div class="ps-review__date">Oct 30, 2021</div>
                                            </div>
                                            <div class="ps-review__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>Everything is perfect. I would recommend!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ps-review--product">
                                        <div class="ps-review__row">
                                            <div class="ps-review__avatar"><img src="img/avatar/avatar-review.html" alt="alt" /></div>
                                            <div class="ps-review__info">
                                                <div class="ps-review__name">Mark J.</div>
                                                <div class="ps-review__date">Oct 30, 2021</div>
                                            </div>
                                            <div class="ps-review__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4" selected="selected">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="ps-review__desc">
                                                <p>There was a small mistake in the order. In return I got the correct order and I could keep the wrong one for myself.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-form--review">
                                    <div class="ps-form__title">Write a review</div>
                                    <div class="ps-form__desc">Your email address will not be published. Required fields are marked *</div>
                                    <form action="http://nouthemes.net/html/mymedi/do_action" method="post">
                                        <div class="row">
                                            <div class="col-12 col-lg-4">
                                                <label class="ps-form__label">Your rating *</label>
                                                <select class="ps-rating--form" data-value="0">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <label class="ps-form__label">Name *</label>
                                                <input class="form-control ps-form__input">
                                            </div>
                                            <div class="col-6 col-lg-4">
                                                <label class="ps-form__label">Email *</label>
                                                <input class="form-control ps-form__input">
                                            </div>
                                            <div class="col-12">
                                                <div class="ps-form__block">
                                                    <label class="ps-form__label">Your review *</label>
                                                    <textarea class="form-control ps-form__textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button class="btn ps-btn ps-btn--warning">Add Review</button>
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
        @if(count($relatedProducts) > 0)
            <section class="ps-section--latest">
                <div class="container">
                    <h3 class="ps-section__title">Benzer Ürünler</h3>
                    <div class="ps-section__carousel">
                        <div class="owl-carousel" data-owl-auto="false" data-owl-loop="false" data-owl-speed="13000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                            @foreach($relatedProducts as $relatedProduct)
                                <div class="ps-section__product">
                                    <div class="ps-product ps-product--standard">
                                        <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('product.show', $relatedProduct->slug) }}">
                                                <figure><img src="{{ asset($relatedProduct->thumb_image) }}" alt="{{ $relatedProduct->name }}" /><img src="{{ asset($relatedProduct->thumb_image) }}" alt="{{ $relatedProduct->name }}" />
                                                </figure>
                                            </a>
                                            <div class="ps-product__actions">
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="javascript:;" onclick="loadProductModal('{{ $relatedProduct->id }}')"><i class="fa fa-shopping-basket"></i></a></div>                                            </div>
                                            <div class="ps-product__badge">
                                                <div class="ps-badge ps-badge--category">{{ $relatedProduct->category->name }}</div>
                                            </div>
                                        </div>
                                        <div class="ps-product__content">
                                            <h5 class="ps-product__title"><a href="{{ route('product.show', $relatedProduct->slug) }}">{!! $relatedProduct->name !!}</a></h5>
                                            <div class="ps-product__meta">
                                                @if($relatedProduct->offer_price > 0)
                                                    <span class="ps-product__price sale">{{ currencyPosition($relatedProduct->offer_price) }}</span>
                                                    <span class="ps-product__del">{{ currencyPosition($relatedProduct->price) }}</span>
                                                @else
                                                    <span class="ps-product__price sale">{{ currencyPosition($relatedProduct->price) }}</span>
                                                @endif
                                            </div>
                                            <div class="ps-product__rating">
                                                <select class="ps-rating" data-read-only="true">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5" selected="selected">5</option>
                                                </select><span class="ps-product__review">( Yorum)</span>
                                            </div>
                                            <div class="ps-product__actions ps-product__group-mobile">
                                                <div class="ps-product__quantity">
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                                        <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="javascript:;" onclick="loadProductModal('{{ $relatedProduct->id }}')"><i class="fa fa-shopping-basket"></i></a></div>
                                                <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                                <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){

            $('.v_product_size').on('change', function() {
                v_updateTotalPrice();

            });

            $('.v_product_option').on('change', function() {
                v_updateTotalPrice();

            });

            // Event Handlers For Increment and Decrement Buttons
            $('.v_increment').on('click', function (e){
                e.preventDefault();
                let quantity = $('#v_quantity');
                let currentQuantity = parseFloat(quantity.val());
                quantity.val(currentQuantity + 1);
                v_updateTotalPrice();
            })

            $('.v_decrement').on('click', function (e){
                e.preventDefault();
                let quantity = $('#v_quantity');
                let currentQuantity = parseFloat(quantity.val());
                if(currentQuantity > 1){
                    quantity.val(currentQuantity - 1);
                    v_updateTotalPrice();
                }
            })

            // Function to Update Total Price Selected Option
            function v_updateTotalPrice(){
                let basePrice = parseFloat($('.v_base_price').val());
                let selectedSizePrice = 0;
                let selectedOptionsPrice = 0;
                let quantity = parseFloat($('#v_quantity').val());

                // Selected Size Price Calculate
                let selectedSize = $('select.v_product_size option:selected');
                if(selectedSize.length > 0){
                    selectedSizePrice = parseFloat(selectedSize.data('price'));
                }

                // Selected Option Price Calculate
                let selectedOptions = $('.v_product_option:checked');
                $(selectedOptions).each(function (){
                    selectedOptionsPrice += parseFloat($(this).data("price"));
                })


                // Calculate The Total Price
                let totalPrice = (basePrice + selectedSizePrice + selectedOptionsPrice) * quantity;
                $('#v_total_price').text("{{ config('settings.site_currency_icon') }}" + totalPrice);

            }

            $('.v_submit_button').on('click', function (e){
                e.preventDefault();
                $('#v_add_to_cart_form').submit();
            })

            // Add To Cart Function
            $('#v_add_to_cart_form').on('submit', function (e){
                e.preventDefault();

                //Validation
                let selectedSize = $('select[name="product_size"] option:selected');
                console.log($('select[name="product_size"] option:selected').val())
                if(selectedSize.length > 0){
                    if($('select[name="product_size"] option:selected').val() === ''){
                        toastr.error('Lütfen Ürün Boyutu Seçiniz');
                        console.error('Lütfen Ürün Boyutu Seçiniz');
                        return;
                    }
                }

                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '{{ route("add-to-cart") }}',
                    data: formData,
                    beforeSend: function () {
                        $('.v_submit_button').attr('disabled', true).html('<span class="loader"></span>Ekleniyor...')
                    },
                    success: function (response) {
                        updateSidebarCart();
                        toastr.success(response.message)
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON.message;
                        toastr.error(errorMessage)
                    },
                    complete: function () {
                        setTimeout(() => {
                            $('.v_submit_button').html('Sepete Ekle').attr('disabled', false);
                        }, 1000);
                    }
                })
            })


        })
    </script>
@endpush
