@extends('frontend.layouts.master')
@section('content')
<div class="ps-account">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="ps-form--review">
                        <h2 class="ps-form__title">ÜYE OL</h2>
                        <!-- Name -->
                        <div class="ps-form__group">
                            <label class="ps-form__label">Ad Soyad *</label>
                            <input id="name" name="name" class="form-control ps-form__input" type="text" value="{{ old('name') }}" required autofocus autocomplete="name">
                        </div>
                        <!-- Email Address -->
                        <div class="ps-form__group">
                            <label class="ps-form__label">E-posta Adresi *</label>
                            <input id="email" name="email" class="form-control ps-form__input" type="email" value="{{ old('email') }}" required autocomplete="username">
                        </div>
                        <!-- Password -->
                        <div class="ps-form__group">
                            <label class="ps-form__label">Şifre *</label>
                            <div class="input-group">
                                <input id="password" name="password" class="form-control ps-form__input" type="password" required autocomplete="new-password">
                                <div class="input-group-append"><a class="fa fa-eye-slash toogle-password" href="javascript: vois(0);"></a></div>
                            </div>
                        </div>
                        <!-- Confirm Password -->
                        <div class="ps-form__group">
                            <label class="ps-form__label">Şifre Tekrar *</label>
                            <div class="input-group">
                                <input id="password_confirmation" name="password_confirmation" class="form-control ps-form__input" type="password" required autocomplete="new-password">
                                <div class="input-group-append"><a class="fa fa-eye-slash toogle-password" href="javascript: vois(0);"></a></div>
                            </div>
                            <p class="ps-form__text">İpucu: Şifre en az 8 karakter uzunluğunda olmalıdır. Daha güçlü kılmak için büyük ve küçük harfler, sayılar ve "#,@,*" gibi semboller kullanın.</p>
                        </div>
                        <div class="ps-form__submit">
                            <button class="ps-btn ps-btn--warning">ÜYE OL</button>
                        </div>
                        <div class="ps-form__group"><a class="ps-account__link" href="{{ route('login') }}">Zaten Üye misiniz ?</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
