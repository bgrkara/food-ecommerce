@extends('admin.layouts.master')
@push('css')
    <style>
        .sw-px-100{
            max-width: 250px !important;
        }
        .sh-px-100{
            max-height: 250px !important;
        }
        .form-control::-webkit-inner-spin-button,
        .form-control::-webkit-outer-spin-button {
            -webkit-appearance: none;   margin: 0;
        }
        .input-group-text{
            font-size: smaller !important;
        }
        .product-image-center{
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .card-title{
            font-size: medium !important;
            color: #433c8f !important;
            font-weight: 300;
        }
        textarea#longDescription{
            border: none !important;
        }
        .tox-promotion , .tox-statusbar__branding{
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Ürün Ekle</span>
        </h4>
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        <div class="row">

            <!-- LeftProductContent -->
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Ürün Bilgileri</h5>
                    </div>
                    <div class="card-body">
                        <!-- ProductName -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">Ürün Adı</label>
                            <input
                                class="form-control"
                                type="text"
                                id="productName"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Ürün Adı Giriniz"
                                autofocus
                            />
                        </div>
                        <div class="row mb-3">
                            <!-- ProductSlug -->
                            <div class="mb-3 col-md-6">
                                <label for="productSlug" class="form-label">Slug</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="productSlug"
                                    name="slug"
                                    value="{{ old('slug') }}"
                                    placeholder="URL Uzantısını Giriniz"
                                    autofocus
                                />
                                <small>Boş Bırakırsanız Otomatik Oluşturacaktır</small>
                            </div>
                            <!-- ProductEAN -->
                            <div class="mb-3 col-md-6">
                                <label for="productEan" class="form-label">SKU</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="productEan"
                                    name="sku"
                                    value="{{ old('sku') }}"
                                    placeholder="SKU No Giriniz"
                                    maxlength="13"
                                    autofocus
                                />
                                <small>Boş Bırakırsanız Otomatik Oluşturacaktır</small>
                            </div>
                        </div>
                        <!-- ProductShortDescription-->
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Kısa Ürün Açıklaması (Opsiyonel)</label>
                            <textarea
                                class="form-control"
                                type="text"
                                id="productDescription"
                                name="short_description"
                                rows="3"
                                placeholder="Kısa Ürün Açıklaması Giriniz"
                                autofocus
                            >{{ old('short_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="longDescription" class="form-label">Ürün Açıklaması (Opsiyonel)</label>
                            <textarea name="long_description" rows="1" id="longDescription"></textarea>
                        </div>
                    </div>
                </div>

                <!-- SEO -->
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- SeoTitle -->
                        <div class="mb-3">
                            <label for="productName" class="form-label">SEO Başlık (Opsiyonel)</label>
                            <input
                                class="form-control"
                                type="text"
                                id="productName"
                                name="seo_title"
                                value="{{ old('seo_title') }}"
                                maxlength="70"
                                placeholder="SEO Başlığı Giriniz (Max:70 Karakter)"
                                autofocus
                            />
                        </div>

                        <!-- SeoDescription -->
                        <div class="mb-3">
                            <label for="seoDescription" class="form-label">SEO Kısa Açıklama (Opsiyonel)</label>
                            <textarea
                                class="form-control"
                                type="text"
                                id="seoDescription"
                                name="seo_description"
                                rows="2"
                                maxlength="250"
                                placeholder="SEO Kısa Açıklama Giriniz (Max:250 Karakter)"
                                autofocus
                            >{{ old('seo_description') }}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /SEO -->
                <!-- Button -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                            <a href="{{ route('admin.category.index') }}" class="btn btn-label-secondary">İptal</a>
                        </div>
                    </div>
                </div>
                <!-- /Button -->
            </div>
            <!-- /LeftProductContent -->
            <!-- RightProductContent -->
            <div class="col-12 col-lg-4">
                <!--PriceContent-->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Fiyat</h5>
                    </div>
                    <div class="card-body">
                        <!-- price -->
                        <div class="mb-3">
                            <label for="productPrice" class="form-label">Normal Fiyat</label>
                            <div class="input-group">
                                <span class="input-group-text">TL</span>
                                <input type="number" name="price" id="productPrice" value="{{ old('price') }}" class="form-control form-control-sm" placeholder="100" aria-label="Tutar">
                            </div>
                        </div>
                        <!-- OfferPrice -->
                        <div class="mb-3">
                            <label for="productOfferPrice" class="form-label">İndirimli Fiyat</label>
                            <div class="input-group">
                                <span class="input-group-text">TL</span>
                                <input type="number" name="offer_price" id="productOfferPrice" value="{{ old('offer_price') }}" class="form-control form-control-sm" placeholder="50" aria-label="Tutar">
                            </div>
                        </div>

                    </div>
                </div>
                <!--OrganizeContent-->"
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- ProductCategory -->
                        <div class="mb-3">
                            <label for="select" class="form-label">Ürün Kategorisi Seçiniz</label>
                            <select name="category" id="select" class="select2 form-select form-select-sm" data-allow-clear="true">
                                <option value="" disabled>Lüften Bir Kategori Seçiniz</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- ShowAtHome -->
                        <div class="mb-3">
                            <label for="select" class="form-label">Anasayfada Göster/Gizle</label>
                            <select name="show_at_home" id="select" class="form-select form-select-sm">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>
                        <!-- Status -->
                        <div class="mb-3">
                            <label for="select" class="form-label">Durum</label>
                            <select name="status" id="select" class="form-select form-select-sm">
                                <option value="1">Aktif</option>
                                <option value="0">Pasif</option>
                            </select>
                        </div>

                    </div>
                </div>
                <!--ImageContent-->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Öne Çıkan Görsel</h5>
                    </div>
                    <div class="card-body ">
                        <!-- Image -->
                        <div class="product-image-center">
                            <img
                                src=" {{ asset('uploads/vendor/thumb-products.jpg') }} "
                                alt="user-avatar"
                                class="d-block sw-px-100 sh-px-100 mb-3 rounded"
                                id="uploadedAvatar" />
                        </div>
                        <div class="button-wrapper product-image-center">
                            <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Fotoğraf Yükle</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input
                                    type="file"
                                    id="upload"
                                    name="image"
                                    class="account-file-input"
                                    hidden
                                    accept="image/png, image/jpeg, image/gif" />
                            </label>
                            <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Sıfırla</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /RightProductContent -->
        </div>
        </form>
    </div>
@endsection
@push('scripts')<script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script><script src="{{ asset('admin/assets/js/forms-file-upload.js') }}"></script><script>
    document.addEventListener('DOMContentLoaded', function (e) {
        (function () {
            // Update/reset user image of account page
            let accountUserImage = document.getElementById('uploadedAvatar');
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
