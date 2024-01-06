<section class="ps-portfolio">
    <div class="container">
        <div class="ps-portfolio__content">
            <h3 class="ps-section__title">Öne Çıkan Ürünler</h3>
            <div class="ps-portfolio__tabs">
                <ul class="nav nav-tabs" id="productContentTabs" role="tablist">
                    <li class="nav-item" role="presentation"><a class="nav-link active" id="portfolio-all-tab" data-toggle="tab" href="#portfolio-all-content" role="tab" aria-controls="portfolio-all-content" aria-selected="true">All</a></li>
                    @foreach($categories as $category)
                        <li class="nav-item" role="presentation"><a class="nav-link" id="product-{{ $category->slug }}-tab" data-toggle="tab" href="#product-{{ $category->slug }}-content" role="tab" aria-controls="product-{{ $category->slug }}-content" aria-selected="false">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
                <div class="tab-content" id="productContent">
                    @foreach($categories as $category)
                        <div class="tab-pane fade show" id="product-{{ $category->slug }}-content" role="tabpanel" aria-labelledby="product-{{ $category->slug }}-tab">
                            <div class="row">
                                @foreach($products as $product)
                                    @if($category->id === $product->category_id)
                                        <div class="col-6 col-md-3 col-lg-2dot4 p-0">
                                            <div class="ps-section__product">
                                                <div class="ps-product ps-product--standard">
                                                    <div class="ps-product__thumbnail"><a class="ps-product__image" href="{{ route('product.show', $product->slug) }}">
                                                            <figure><img src="{{ asset($product->thumb_image)}}" alt="{{ $product->name }}" />
                                                            </figure>
                                                        </a>
                                                        <div class="ps-product__actions">
                                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                                            <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"><i class="fa fa-shopping-basket"></i></a></div>
                                                        </div>
                                                        <div class="ps-product__badge">
                                                            <div class="ps-badge ps-badge--category">{{ @$product->category->name }}</div>
                                                        </div>
                                                    </div>
                                                    <div class="ps-product__content">
                                                        <h5 class="ps-product__title"><a href="#">{{ $product->name }}</a></h5>
                                                        <div class="ps-product__meta">
                                                            @if($product->offer_price > 0)
                                                                <span class="ps-product__price sale">{{ currencyPosition($product->offer_price) }}</span>
                                                                <span class="ps-product__del">{{ currencyPosition($product->price) }}</span>
                                                            @else
                                                                <span class="ps-product__price sale">{{ currencyPosition($product->price) }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="ps-product__rating">
                                                            <select class="ps-rating" data-read-only="true">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5" selected="selected">5</option>
                                                            </select><span class="ps-product__review">( Değerlendirme )</span>
                                                        </div>
                                                        <div class="ps-product__desc">
                                                            <ul class="ps-product__list">
                                                                <li>Study history up to 30 days</li>
                                                                <li>Up to 5 users simultaneously</li>
                                                                <li>Has HEALTH certificate</li>
                                                            </ul>
                                                        </div>
                                                        <div class="ps-product__actions ps-product__group-mobile">
                                                            <div class="ps-product__quantity">
                                                                <div class="def-number-input number-input safari_only">
                                                                    <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                                                    <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                                                    <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="javascript:;" onclick="loadProductModal('{{ $product->id }}')"><i class="fa fa-shopping-basket"></i></a></div>
                                                            <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                                            <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="ps-portfolio__button"> <a class="ps-btn ps-btn--primary" href="#">Load more</a></div>
        </div>
    </div>
</section>
