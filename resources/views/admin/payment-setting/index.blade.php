@extends('admin.layouts.master')
@push('css')
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <style>
        ul.nav-tabs{
            min-width: 200px !important;
        }
        .iyzico-logo{
            max-width: 17px;
        }
        .paypal_img_content img {
            max-width: 200px;
            max-height: 40px;
            border: 2px solid #e2e0f3;
            padding: 10px;
            margin-right: 30px;
        }
        .stripe_img_content img {
            max-width: 200px;
            max-height: 40px;
            border: 2px solid #e2e0f3;
            padding: 10px;
            margin-right: 30px;
        }
        .iyzico_img_content img {
            max-width: 200px;
            max-height: 40px;
            border: 2px solid #e2e0f3;
            padding: 10px;
            margin-right: 30px;
        }
        .pay-img-content{
            margin-top: 40px !important;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Ödeme Ayarları</span>
        </h4>
            <!-- Payment Gateway -->
            <div class="row">
                <div class="col">
                    <h6 class="mt-4">Tüm Ödeme Ayarları</h6>
                    <div class="card mb-3">
                        <div class="card-header pt-2">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item">
                                    <button
                                        class="nav-link active"
                                        data-bs-toggle="tab"
                                        data-bs-target="#paypal-setting"
                                        role="tab"
                                        aria-selected="true">
                                        <i class="ti ti-brand-paypal-filled"></i> Paypal
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#stripe-setting"
                                        role="tab"
                                        aria-selected="false">
                                        <i class="ti ti-brand-stripe"></i> Stripe
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        class="nav-link"
                                        data-bs-toggle="tab"
                                        data-bs-target="#iyzico-setting"
                                        role="tab"
                                        aria-selected="false">
                                        <img class="iyzico-logo" src="{{ asset('admin/assets/img/icons/brands/iyzico.png') }}" alt="">Iyzico
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <!-- PayPal Gateway Content -->
                            @include('admin.payment-setting.sections.paypal')
                            <!-- Stripe Gateway Content -->
                            @include('admin.payment-setting.sections.stripe')
                            <!-- Iyzico Gateway Content -->
                            @include('admin.payment-setting.sections.iyzico')
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@push('scripts')<script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
<script src="{{ asset('admin/assets/js/forms-file-upload.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function (e) {
        (function () {
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedLogo');
            const fileInput = document.querySelector('.account-file-input'),
                resetFileInput = document.querySelector('.account-image-reset');

            if (accountUserImage) {
                const resetImage = accountUserImage.src;
                fileInput.onchange = () => {
                    if (fileInput.files[0]) {
                        accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                    }
                };
                resetFileInput.onclick = () => {
                    fileInput.value = '';
                    accountUserImage.src = resetImage;
                };
            }
        })();
    });
</script>
<script src="{{ asset('admin/assets/js/forms-selects.js') }}"></script>
@endpush
