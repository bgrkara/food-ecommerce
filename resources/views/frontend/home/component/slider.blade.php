<section class="ps-section--banner ps-banner--container">
    <div class="ps-section__overlay">
        <div class="ps-section__loading"></div>
    </div>
    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="15000" data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        @foreach($sliders as $slider)
        <div class="ps-banner" style="background:#103178;">
            <div class="container-no-round">
                <div class="ps-banner__block">
                    <div class="ps-banner__content">
                        <h2 class="ps-banner__title text-white">{!! $slider->title !!}</h2>
                        @if($slider->sub_title)<div class="ps-banner__desc text-white">{!! $slider->sub_title !!}</div>@endif
                        @if($slider->short_description)<p class="fs-2 text-white">{!! $slider->short_description !!}</p>@endif
                        @if($slider->discount_price)<div class="ps-banner__price"> <span class="text-yellow">{{ currencyPosition($slider->discount_price) }}</span>
                            @if($slider->price)<del>{{ currencyPosition($slider->price) }}</del>@endif
                        </div>@endif
                        @if($slider->button_link)<a class="bg-yellow ps-banner__shop" href="https://{{ $slider->button_link }}">İncele</a>@endif
                        @if($slider->offer)<div class="ps-banner__persen bg-yellow">{{ $slider->offer }}% <small>İndirim</small></div>@endif
                    </div>
                    <div class="ps-banner__thumnail ps-banner__fluid"><img class="ps-banner__image" src="{{ asset($slider->image) }}" alt="alt" />
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
