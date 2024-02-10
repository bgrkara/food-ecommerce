@extends('frontend.layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
<style>
    .photo-label-btn{
        border: 4px solid #b3c1e0;
        padding: 0 15px;
        border-radius: 25px;
        margin-top: 10px;
        color: #ffffff;
        background-color: #323f5c;
        cursor: pointer;
    }
</style>
@endpush
@section('content')
    <div class="container">
        <section class="mt-60 mb-60">
            <div class="row mt-40">
                <div class="col-md-4">
                    <div class="text-center dash-bg-white dash-pt-4 mb-4">
                        <div class="dash-header-img">
                            <img src="{{ auth()->user()->avatar }}" alt="" class="rounded-circle dash-image">
                            <form id="avatar_form">
                                <input type="file" name="avatar" id="upload" accept="image/*" hidden>
                            </form>
                        </div>
                        <label class="photo-label-btn" for="upload"><i class="fa fa-camera-retro" aria-hidden="true"></i> Fotoğraf Ekle</label>
                        <div><p class="user-name">{{ auth()->user()->name }}</p></div>
                    </div>
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
                        <!--User Info-->
                        @include('frontend.dashboard.sections.user-info-section')
                        <!--Address Info-->
                        @include('frontend.dashboard.sections.address-section')
                        <!--Orders Info-->
                        @include('frontend.dashboard.sections.orders-section')
                        <!--Change Password-->
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
