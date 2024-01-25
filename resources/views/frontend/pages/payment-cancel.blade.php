@extends('frontend.layouts.master')
@push('css')
    <style>
        .ps-page__content img {
            max-width: 200px;
        }
        .ps-page--paymentstatus .ps-page__name { font-size: 85px !important; line-height: 100px !important;}
    </style>
@endpush
@section('content')
    <div class="ps-page--paymentstatus">
        <div class="container">
            <div class="ps-page__content">
                <div class="row">
                    <div class="col-12 mt-60"><img src="{{ asset('frontend/img/payment-cancel.png') }}" alt="payment-success"></div>
                    <div class="col-12 text-center mb-60">
                        <h1 class="ps-page__name">İşlem Başarısız!</h1>
                        <p>{{ session()->has('errors') ? session('errors')->first('error') : '' }}</p>
                        <div><a class="ps-btn ps-btn--primary" href="{{ route('home') }}">Alışverişe Devam Et</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
