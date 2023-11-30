@extends('frontend.layouts.master')
@section('content')
<div class="ps-home ps-home--2">
    <div class="ps-home__content">
        <div class="container">
            <!--Slider Content-->
            @include('frontend.home.component.slider')
            <!--Promo 1-->
            @include('frontend.home.component.promo_first')
            <!--Product Category-->
            @include('frontend.home.component.product_category')
        </div>
            <!--Product List Carousel-->
            @include('frontend.home.component.product_list_carousel')
        <div class="container">
            <!--Product Deals-->
            @include('frontend.home.component.product_deals')
            <!--Promo 2-->
            @include('frontend.home.component.promo_second')
            <!--Promo 3-->
            @include('frontend.home.component.promo_third')
            <!--Product List Grid-->
            @include('frontend.home.component.product_list_grid')
            <!--Blog-->
            @include('frontend.home.component.blog')
            <!--Subscription-->
            @include('frontend.home.component.subscription')
        </div>
    </div>
</div>
@endsection
