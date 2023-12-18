@extends('frontend.layouts.master')
@section('content')
    <div class="ps-page--product-variable">
        <div class="container">
            <ul class="ps-breadcrumb">
                <li class="ps-breadcrumb__item"><a href="{{ route('home') }}">Anasayfa</a></li>
                <li class="ps-breadcrumb__item"><a href="#">Category</a></li>
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
                                            <div class="slide"><img src="{{ asset('frontend/img/products/008.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ asset('frontend/img/products/009.jpg') }}" alt="alt" /></div>
                                            <div class="slide"><img src="{{ asset('frontend/img/products/045.jpg') }}" alt="alt" /></div>
                                        </div>
                                        <div class="ps-gallery--image">
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ asset('frontend/img/products/028.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ asset('frontend/img/products/008.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ asset('frontend/img/products/009.jpg') }}" alt="alt" /></div>
                                            </div>
                                            <div class="slide">
                                                <div class="ps-gallery__item"><img src="{{ asset('frontend/img/products/045.jpg') }}" alt="alt" /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-5">
                                    <div class="ps-product__info">
                                        <div class="ps-product__branch"><a href="#">WeTakeCare</a></div>
                                        <div class="ps-product__title"><a href="#">Digital Thermometer X30-Pro</a></div>
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
                                            <ul class="ps-product__list">
                                                <li>Study history up to 30 days</li>
                                                <li>Up to 5 users simultaneously</li>
                                                <li>Has HEALTH certificate</li>
                                            </ul>
                                        </div>
                                        <ul class="ps-product__bundle">
                                            <li><i class="icon-wallet"></i>100% Money back</li>
                                            <li><i class="icon-bag2"></i>Non-contact shipping</li>
                                            <li><i class="icon-truck"></i>Free delivery for order over $200</li>
                                        </ul>
                                        <div class="ps-product__type">
                                            <ul class="ps-product__list">
                                                <li> <span class="ps-list__title">Tags: </span><a class="ps-list__text" href="#">Health</a><a class="ps-list__text" href="#">Thermometer</a>
                                                </li>
                                                <li> <span class="ps-list__title">SKU: </span><a class="ps-list__text" href="#">8DJ21A</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__social">
                                            <ul class="ps-social ps-social--color">
                                                <li><a class="ps-social__link facebook" href="#"><i class="fa fa-facebook"> </i><span class="ps-tooltip">Facebook</span></a></li>
                                                <li><a class="ps-social__link twitter" href="#"><i class="fa fa-twitter"></i><span class="ps-tooltip">Twitter</span></a></li>
                                                <li><a class="ps-social__link pinterest" href="#"><i class="fa fa-pinterest-p"></i><span class="ps-tooltip">Pinterest</span></a></li>
                                                <li class="ps-social__linkedin"><a class="ps-social__link linkedin" href="#"><i class="fa fa-linkedin"></i><span class="ps-tooltip">Linkedin</span></a></li>
                                                <li class="ps-social__reddit"><a class="ps-social__link reddit-alien" href="#"><i class="fa fa-reddit-alien"></i><span class="ps-tooltip">Reddit Alien</span></a></li>
                                                <li class="ps-social__email"><a class="ps-social__link envelope" href="#"><i class="fa fa-envelope-o"></i><span class="ps-tooltip">Email</span></a></li>
                                                <li class="ps-social__whatsapp"><a class="ps-social__link whatsapp" href="#"><i class="fa fa-whatsapp"></i><span class="ps-tooltip">WhatsApp</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="ps-product__feature">
                                <div class="ps-product__badge"><span class="ps-badge ps-badge--outstock">OUT OF STOCK</span>
                                </div>
                                <div class="ps-product__meta"><span class="ps-product__price sale">$89.74</span><span class="ps-product__del">$60.24</span>
                                </div>
                                <div class="ps-product__variable">
                                    <div class="ps-product__attribute">
                                        <h6>Color</h6>
                                        <select class="form-select">
                                            <option selected="selected">Choose an option</option>
                                            <option value="Gray">Gray</option>
                                            <option value="Red">Red</option>
                                            <option value="Black">Black</option>
                                        </select>
                                    </div>
                                    <div class="ps-product__attribute">
                                        <h6>Size</h6>
                                        <select class="form-select">
                                            <option selected="selected">Choose an option</option>
                                            <option value="L">L</option>
                                            <option value="M">M</option>
                                            <option value="S">S</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ps-product__quantity">
                                    <h6>Quantity</h6>
                                    <div class="def-number-input number-input safari_only">
                                        <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="icon-minus"></i></button>
                                        <input class="quantity" min="0" name="quantity" value="1" type="number" />
                                        <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="icon-plus"></i></button>
                                    </div>
                                </div><a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcartV2">Add to cart</a>
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
                                    <h2 class="ps-title">Digital Thermometer X30-Pro</h2>
                                    <p class="ps-desc">Just a few seconds to measure your body temperature. Up to 5 users! The battery lasts up to 2 years. There are many variations of passages of Lorem Ipsum available, but the majority have suffered altevration in some form, by injected humour, or randomised words which don’t look even slightly believable.</p>
                                    <p class="ps-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                    <ul class="ps-list">
                                        <li class="d-inline-block" style="margin: 0 55px 15px 0;"><img src="img/icon/bacterial.svg" alt=""><span>Study history up to 30 days</span></li>
                                        <li class="d-inline-block" style="margin: 0 55px 15px 0;"><img src="img/icon/virus.svg" alt=""><span>Up to 5 users simultaneously</span></li>
                                        <li class="d-inline-block" style="margin: 0 55px 15px 0;"><img src="img/icon/ribbon.svg" alt=""><span>Has HEALTH certificate</span></li>
                                    </ul>
                                    <table class="table ps-table ps-table--oriented m-0">
                                        <tbody>
                                        <tr>
                                            <th class="ps-table__th">Power</th>
                                            <td>5,049</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-table__th">Windows</th>
                                            <td>64bit Windows 7*, 8 or 10</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-table__th">Graphic Card</th>
                                            <td>4Gb dedicated Graphics card (such as NVIDIA – Open GL 4.0 or later)</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-table__th">HDD</th>
                                            <td>500Gb HDD (this is more driven by the amount of data you want to keep on your computer, rather than LSS itself)</td>
                                        </tr>
                                        <tr>
                                            <th class="ps-table__th">Screen</th>
                                            <td>Single HD Screen (1920×1080 with 100% desktop scaling) or 1366×768 with second monitor 1920×1080 or higher</td>
                                        </tr>
                                        </tbody>
                                    </table>
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
        <section class="ps-section--latest" data-background="img/related-bg.jpg">
            <div class="container">
                <h3 class="ps-section__title">Latest products</h3>
                <div class="ps-section__carousel">
                    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="13000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5" data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5" data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/001.jpg" alt="alt" /><img src="img/products/009.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                        <div class="ps-badge ps-badge--sold">Sold Out</div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Digital Thermometer X30-Pro</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price sale">$77.65</span><span class="ps-product__del">$80.65</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/053.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Somersung Sonic X500 Basic</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price sale">$38.39</span><span class="ps-product__del">$53.99</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/054.jpg" alt="alt" /><img src="img/products/057.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                        <div class="ps-badge ps-badge--hot">Hot</div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Somersung Sonic X2000 Pro Black</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$299.99</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4" selected="selected">4</option>
                                            <option value="5">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/055.jpg" alt="alt" /><img src="img/products/056.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Somersung Sonic X2500 Pro White</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$39.99</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/006.jpg" alt="alt" /><img src="img/products/051.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                        <div class="ps-badge ps-badge--sold">Sold Out</div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">GAnti-Dust Filter, Breathable, 3 Layers of Purifying</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$17.99</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/017.jpg" alt="alt" /><img src="img/products/002.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Red Hot Water Bottle, 2 Quart Capacity</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$13.64</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/028.jpg" alt="alt" /><img src="img/products/045.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                        <div class="ps-badge ps-badge--sold">Sold Out</div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Digital Thermometer X30-Pro</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price sale">$88.39</span><span class="ps-product__del">$60.23</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/042.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Extractor used to remove teeth</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$53.64</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected="selected">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-section__product">
                            <div class="ps-product ps-product--standard">
                                <div class="ps-product__thumbnail"><a class="ps-product__image" href="product1.html">
                                        <figure><img src="img/products/016.jpg" alt="alt" /><img src="img/products/021.jpg" alt="alt" />
                                        </figure>
                                    </a>
                                    <div class="ps-product__actions">
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="#"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="#" data-toggle="modal" data-target="#popupCompare"><i class="fa fa-align-left"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Quick view"><a href="#" data-toggle="modal" data-target="#popupQuickview"><i class="fa fa-search"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#" data-toggle="modal" data-target="#popupAddcart"><i class="fa fa-shopping-basket"></i></a></div>
                                    </div>
                                    <div class="ps-product__badge">
                                        <div class="ps-badge ps-badge--hot">Hot</div>
                                    </div>
                                </div>
                                <div class="ps-product__content">
                                    <h5 class="ps-product__title"><a href="product1.html">Oxygen concentrator model KTS-5000</a></h5>
                                    <div class="ps-product__meta"><span class="ps-product__price">$432.64</span>
                                    </div>
                                    <div class="ps-product__rating">
                                        <select class="ps-rating" data-read-only="true">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4" selected="selected">4</option>
                                            <option value="5">5</option>
                                        </select><span class="ps-product__review">( Reviews)</span>
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
                                        <div class="ps-product__cart"> <a class="ps-btn ps-btn--warning" href="#" data-toggle="modal" data-target="#popupAddcart">Add to cart</a></div>
                                        <div class="ps-product__item cart" data-toggle="tooltip" data-placement="left" title="Add to cart"><a href="#"><i class="fa fa-shopping-basket"></i></a></div>
                                        <div class="ps-product__item" data-toggle="tooltip" data-placement="left" title="Wishlist"><a href="wishlist.html"><i class="fa fa-heart-o"></i></a></div>
                                        <div class="ps-product__item rotate" data-toggle="tooltip" data-placement="left" title="Add to compare"><a href="compare.html"><i class="fa fa-align-left"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
