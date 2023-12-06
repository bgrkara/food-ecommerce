@extends('admin.layouts.master')
@push('css')<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/css/slider.css') }}" />@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Slider Ekle</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                </div>
                <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src=" {{ asset('uploads/vendor/slider-placeholder.png') }} "
                                alt="user-avatar"
                                class="d-block sw-px-100 sh-px-100 rounded"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
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

                                <div class="text-muted">İzin verilen JPG, GIF veya PNG. Maksimum boyut 800K</div>
                            </div>
                        </div>
                    </div>
                    <!-- /Photo-->
                    <hr class="my-0" />
                    <!-- Category -->
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Başlık</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="title"
                                    name="title"
                                    value=""
                                    placeholder="Başlık Giriniz"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="subtitle" class="form-label">Alt Başlık</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="subtitle"
                                    name="sub_title"
                                    value=""
                                    placeholder="Alt Başlık Giriniz"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Kısa Açıklama</label>
                                <textarea
                                    class="form-control"
                                    type="text"
                                    id="description"
                                    name="short_description"
                                    rows="1"
                                    placeholder="Kısa Açıklama Giriniz"
                                    autofocus
                                ></textarea>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="buttonlink" class="form-label">Promosyon URL</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="buttonlink"
                                    name="button_link"
                                    value=""
                                    placeholder="https://siteadi.com/uzanti"
                                    autofocus
                                />
                            </div>
                        </div>
                       <div class="row">
                           <div class="mb-3 col-md-6">
                               <label for="price_column" class="form-label">Normal Fiyat</label>
                               <div class="input-group">
                                   <span class="input-group-text">TL</span>
                                   <input type="number" name="price" id="price_column" class="form-control" placeholder="100" aria-label="Tutar">
                               </div>
                           </div>
                           <div class="mb-3 col-md-6">
                               <label for="discount_price_column" class="form-label">İndirimli Fiyat</label>
                               <div class="input-group">
                                   <span class="input-group-text">TL</span>
                                   <input type="number" name="discount_price" id="discount_price_column" class="form-control" placeholder="50" aria-label="Tutar">
                               </div>
                           </div>
                       </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="offercolumn" class="form-label">İndirim Yüzdesi</label>
                                <div class="input-group">
                                    <span class="input-group-text">%</span>
                                    <input type="number" name="offer" id="offercolumn" class="form-control" placeholder="30" aria-label="Yüzde">
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="select" class="form-label">Durum</label>
                                <select name="status" id="select" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                            <a href="{{ route('admin.slider.index') }}" class="btn btn-label-secondary">İptal</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Media -->
        </div>
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
</script>@endpush
