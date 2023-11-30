@extends('frontend.layouts.master')
@section('content')
    <div class="ps-account">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="ps-form--review">
                            <h2 class="ps-form__title">ŞİFRE DEĞİŞİKLİĞİ</h2>
                            <div class="ps-form__group">
                                <label class="ps-form__label">E-posta Adresi *</label>
                                <input id="email" name="email" class="form-control ps-form__input" type="email" value="{{ old('email') }}" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="ps-form__submit">
                                <button class="ps-btn ps-btn--warning">{{ __('ŞİFREMİ SIFIRLA') }}</button>
                            </div>
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
                        <div>
                            <a href="{{ route('login') }}" class="ps-btn ps-btn--warning mx-w-none mt-4">ÜYEYSEN GİRİŞ YAP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
