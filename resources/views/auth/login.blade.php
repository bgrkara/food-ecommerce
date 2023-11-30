@extends('frontend.layouts.master')
@section('content')
<div class="ps-account">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="ps-form--review">
                        <h2 class="ps-form__title">ÜYE GİRİŞİ YAP</h2>
                        <div class="ps-form__group">
                            <label class="ps-form__label">E-posta Adresi *</label>
                            <input id="email" name="email" class="form-control ps-form__input" type="email" required autofocus autocomplete="username" value="{{ old('email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="ps-form__group">
                            <label class="ps-form__label">Şifre *</label>
                            <div class="input-group">
                                <input class="form-control ps-form__input" name="password" type="password" required autocomplete="current-password">
                                <div class="input-group-append"><a class="fa fa-eye-slash toogle-password" href="javascript: vois(0);"></a></div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                        </div>
                        <div class="ps-form__submit">
                            <button class="ps-btn ps-btn--warning">GİRİŞ YAP</button>
                            <div class="form-check">
                                <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                <label class="form-check-label" for="remember">Beni Hatırla</label>
                            </div>
                        </div><a class="ps-account__link" href="{{ route('password.request') }}">Şifremi Unuttum ?</a>
                    </div>
                </form>
            </div>
            <div class="col-12 col-md-6">
                    <div class="ps-form--review">
                        <h2 class="ps-form__title">ÜYE DEĞİL MİSİNİZ?</h2>
                        <div><h3 class="regist-fnt">Üye değil misiniz? Hemen üye olun ve fırsatlarımızdan yararlanın. Sizi aramızda görmekten mutluluk duyarız.</h3></div>
                        <div>
                            <a href="{{ route('register') }}" class="ps-btn ps-btn--warning mx-w-none">ÜYE OL</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
