@extends('frontend.layouts.master')
@push('css')<link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">@endpush
@section('content')
    <div class="container">
        <h3 class="ps-section__title text-center">Kullanıcı Paneli</h3>
        <section class="mt-60">
            <div class="row">
                <div class="col-md-4 text-center dash-bg-white dash-pt-4">
                    <div class="dash-header-img">
                        <img src="{{ auth()->user()->avatar }}" alt="" class="rounded-circle dash-image">
                        <label for="upload"><i class="fa fa-camera-retro" aria-hidden="true"></i></label>
                        <form id="avatar_form">
                            <input type="file" name="avatar" id="upload" accept="image/*" hidden>
                        </form>
                    </div>
                    <div><p class="user-name">{{ auth()->user()->name }}</p></div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4 dash-order dash-bg-white">
                            <div class="ps-section--categories mt-4">
                                <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-all.svg')}}" alt></a><a class="ps-categories__name" href="#">Toplam Sipariş</a></div>
                            </div>
                        </div>
                        <div class="col-md-4 dash-order dash-bg-white">
                            <div class="ps-section--categories mt-4">
                                <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-approve.svg')}}" alt></a><a class="ps-categories__name" href="#">Tamamlanan</a></div>
                            </div>
                        </div>
                        <div class="col-md-4 dash-order dash-bg-white">
                            <div class="ps-section--categories mt-4">
                                <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-cancel.svg')}}" alt></a><a class="ps-categories__name" href="#">İptal Edilen</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-40">
                <div class="col-md-4">
                    <div class="ps-widget__content ps-widget__category">
                        <ul class="menu--mobile nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                            <li><a href="#userinfo" data-toggle="tab"><i class="fa fa-user"></i> Kullanıcı Bilgileri</a></li>
                            <li><a href="#address" data-toggle="tab"><i class="fa fa-map-o"></i> Adreslerim</a></li>
                            <li><a href="#orders" data-toggle="tab"><i class="fa fa-shopping-basket"></i>Siparişler</a></li>
                            <li><a href="#wishlist" data-toggle="tab"><i class="fa fa-heart-o"></i> İstek Listesi</a></li>
                            <li><a href="#comments" data-toggle="tab"><i class="fa fa-star-o"></i> Yorumlar</a></li>
                            <li><a href="#pass" data-toggle="tab"><i class="fa fa-key"></i> Şifre İşlemleri</a></li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <li class="exit-form"><a href="#" onclick="event.preventDefault(); this.closest('form').submit();" data-toggle="tab"><i class="fa fa-sign-out"></i> Çıkış</a></li>
                            </form>

                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="userinfo">
                            <!--Form-->
                            <div class="col-md-12">
                                <form method="POST" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="ps-form--review">
                                        <h2 class="ps-form__title mb-5">Kişisel Bilgiler</h2>
                                        <div class="ps-form__group">
                                            <label class="ps-form__label">Ad Soyad *</label>
                                            <input id="name" name="name" placeholder="Ad Soyad" class="form-control ps-form__input" type="text" required autofocus value="{{ auth()->user()->name }}">
                                        </div>
                                        <div class="ps-form__group">
                                            <label class="ps-form__label">E-posta Adresi *</label>
                                            <input name="email" placeholder="E-Posta Adresiniz" class="form-control ps-form__input" type="email" required autofocus value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="ps-form__submit mt-4">
                                            <button class="ps-btn ps-btn--warning">Kaydet</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--/Form-->
                        </div>
                        @include('frontend.dashboard.change-password')
                    </div>

                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function (){
           $('#upload').on('change', function (){

               let form = document.getElementById("avatar_form");
               let form_data = new FormData(form);
               $.ajax({
                   method: 'POST',
                   url: '{{ route('profile.avatar.update') }}',
                   data: form_data,
                   processData: false,
                   contentType: false,
                   success: function (response){
                       if(response.status === 'success'){
                           location.reload();
                       }
                   },
                   error: function (error) {
                       console.log(error)
                   }
               })
           })
        });
    </script>
@endpush
