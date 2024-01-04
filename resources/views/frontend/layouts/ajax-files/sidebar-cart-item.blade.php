<input type="hidden" value="{{ cartTotal() }}" id="cart_total">
<input type="hidden" value="{{ count(Cart::content()) }}" id="cart_product_count">
@foreach(Cart::content() as $cartProduct)
    <li class="ps-cart__item">
        <div class="ps-product--mini-cart"><a class="ps-product__thumbnail" href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}"><img src="{{ asset($cartProduct->options->product_info['image']) }}" alt="{!! $cartProduct->name !!}" /></a>
            <div class="ps-product__content"><a class="ps-product__name" href="{{ route('product.show', $cartProduct->options->product_info['slug']) }}">{!! $cartProduct->name !!}</a>
                <p class="cart-text">Adet: {{ $cartProduct->qty }}</p>
                @if(!empty($cartProduct->options['product_size']))
                    <p class="cart-text">Boyut: {{ @$cartProduct->options['product_size']['name'] }} {{ @$cartProduct->options['product_size']['price'] ? '('.currencyPosition(@$cartProduct->options['product_size']['price']).')' : '' }}</p>
                @endif
                @if(!empty($cartProduct->options['product_options']))
                    <p class="cart-text">Seçenekler:</p>
                    <ul class="ps-cart__items">
                        @foreach($cartProduct->options->product_options as $cartProductOption)
                            <li class="cart-list-item">{{ $cartProductOption['name'] }} {{ $cartProductOption['price'] ? '('.currencyPosition($cartProductOption['price']).')' : '' }}</li>
                        @endforeach
                    </ul>
                @endif
                <p class="ps-product__meta line-height-0"><span class="ps-product__name">Fiyat: {{ currencyPosition($cartProduct->price) }}</p>
            </div><a class="ps-product__remove cart-remove-btn-{{ $cartProduct->id }}" onclick="removeProductFromSidebar('{{ $cartProduct->rowId }}', '{{ $cartProduct->id }}')" href="javascript: void(0)"><i class="icon-cross"></i></a>
        </div>
    </li>
@endforeach
