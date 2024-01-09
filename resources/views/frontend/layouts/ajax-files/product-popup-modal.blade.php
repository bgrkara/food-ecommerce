<style>
    .ps-product--detail .ps-product__price{
        font-size: 29px !important;
    }
    .ps-product--detail .ps-product__meta {
        margin-bottom: 10px !important;
        padding-top: 0 !important;
        margin-top: 0 !important;
    }
    .ps-addcart .ps-addcart__noti{
        background-color: #fd8d27 !important;
    }
</style>
<div class="modal fade" id="popupAddcart" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered ps-addcart">
        <div class="modal-content">
            <div class="modal-body">
                <div class="wrap-modal-slider container-fluid ps-addcart__body">
                    <button class="close ps-addcart__close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <p class="ps-addcart__noti"> <i class="fa fa-check"> </i>Lütfen Ürününüzü Sepete Ekleyiniz</p>
                    <form action="" id="modal_add_to_cart_form">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="row">
                        <div class="col-12 col-md-6">
                                <div class="ps-product ps-product--standard">
                                    <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('product.show', $product->slug) }}">
                                            <figure><img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" /><img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" />
                                            </figure>
                                        </a>
                                        <div class="ps-product__badge">
                                            <div class="ps-badge ps-badge--sale">{{ $product->category->name }}</div>
                                        </div>
                                    </div>
                                    <div class="ps-product__content">

{{--                                        <div class="ps-product__actions ps-product__group-mobile">--}}
{{--                                            <div class="ps-product__quantity">--}}
{{--                                                <div class="def-number-input number-input safari_only">--}}
{{--                                                    <button class="decrement"><i class="icon-minus"></i></button>--}}
{{--                                                    <input class="quantity" name="quantity" value="" type="text" />--}}
{{--                                                    <button class="increment"><i class="icon-plus"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>--}}
{{--                                            <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>--}}
{{--                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>--}}
{{--                                            <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        <div class="col-12 col-md-6">
                                <div class="ps-product--detail">
                                    <div class="ps-addcart__content">
                                        <h5 class="ps-product__title"><a href="{{ route('product.show', $product->slug) }}">{!! $product->name !!}</a></h5>

                                        <div class="ps-product__meta">
                                            @if($product->offer_price > 0)
                                                <input type="hidden" name="base_price" value="{{ currencyPosition($product->offer_price) }}">
                                                <span class="ps-product__price sale">{{ currencyPosition($product->offer_price) }}</span>
                                                <span class="ps-product__del">{{ currencyPosition($product->price) }}</span>
                                            @else
                                                <input type="hidden" name="base_price" value="{{ currencyPosition($product->price) }}">
                                                <span class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                            @endif
                                        </div>

                                        <div class="ps-product__variable">
                                            @if($product->productSizes()->exists())
                                                <div class="ps-product__attribute">
                                                    <h6>Boyut (*Zorunlu)</h6>
                                                    <select name="product_size" class="form-select" required>
                                                        <option value="" data-price="0">Bir Seçenek Seçin</option>
                                                        @foreach($product->productSizes as $productSize)
                                                            <option data-price="{{ $productSize->price }}" value="{{ $productSize->id }}">{{ $productSize->name }} + {{ currencyPosition($productSize->price) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            @endif
                                            @if($product->productOptions()->exists())
                                                <div class="ps-product__attribute">
                                                    <h6>Ek Seçenekler (Opsiyonel)</h6>
                                                        @foreach($product->productOptions as $productOption)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="product_option[]" data-price="{{ $productOption->price }}" value="{{ $productOption->id }}" id="size-{{ $productOption->id }}">
                                                                <label class="form-check-label" for="size-{{ $productOption->id }}">
                                                                    {{ $productOption->name }} + {{ currencyPosition($productOption->price) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="ps-product__quantity">
                                                    <h6>Adet</h6>
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus decrement"><i class="icon-minus"></i></button>
                                                        <input type="number" id="quantity" value="1" min="0" name="quantity" placeholder="1" readonly />
                                                        <button class="plus increment"><i class="icon-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <h6>Toplam</h6>
                                                <div class="ps-product__meta">
                                                    @if($product->offer_price > 0)
                                                        <span id="total_price" class="ps-product__price sale">{{ currencyPosition($product->offer_price) }}</span>
                                                    @else
                                                        <span id="total_price" class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                            @if($product->quantity === 0)
                                            <button type="button" class="ps-btn ps-btn--none-stock modal_cart_button">Stokta Yok</button>
                                            @else
                                            <button type="submit" class="ps-btn ps-btn--warning modal_cart_button">Sepete Ekle</button>
                                            @endif
                                    </div>
                                </div>

                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('select[name="product_size"]').on('change', function() {
            updateTotalPrice();
        });

        $('input[name="product_option[]"]').on('change', function() {
            updateTotalPrice();
        });

        // Event Handlers For Increment and Decrement Buttons
        $('.increment').on('click', function (e){
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            quantity.val(currentQuantity + 1);
            updateTotalPrice();
        })

        $('.decrement').on('click', function (e){
            e.preventDefault();
            let quantity = $('#quantity');
            let currentQuantity = parseFloat(quantity.val());
            if(currentQuantity > 1){
                quantity.val(currentQuantity - 1);
                updateTotalPrice();
            }
        })

        // Function to Update Total Price Selected Option
        function updateTotalPrice(){
            let basePrice = parseFloat($('input[name="base_price"]').val());
            let selectedSizePrice = 0;
            let selectedOptionsPrice = 0;
            let quantity = parseFloat($('#quantity').val());

            // Selected Size Price Calculate
            let selectedSize = $('select[name="product_size"] option:selected');
            if(selectedSize.length > 0){
                selectedSizePrice = parseFloat(selectedSize.data('price'));
            }

            // Selected Option Price Calculate
            let selectedOptions = $('input[name="product_option[]"]:checked');
            $(selectedOptions).each(function (){
                selectedOptionsPrice += parseFloat($(this).data("price"));
            })


            // Calculate The Total Price
            let totalPrice = (basePrice + selectedSizePrice + selectedOptionsPrice) * quantity;
            $('#total_price').text("{{ config('settings.site_currency_icon') }}" + totalPrice);

        }

        // Add To Cart Function
        $('#modal_add_to_cart_form').on('submit', function (e){
            e.preventDefault();

            //Validation
            let selectedSize = $('select[name="product_size"]');
            console.log(selectedSize)
            if(selectedSize.length > 0){
                if($('select[name="product_size"] option:selected').val() === undefined){
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
                    $('.modal_cart_button').attr('disabled', true).html('<span class="loader"></span>Ekleniyor...')
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
                        $('.modal_cart_button').html('Sepete Ekle').attr('disabled', false);
                    }, 1000);
                }
            })
        })

    })
</script>
