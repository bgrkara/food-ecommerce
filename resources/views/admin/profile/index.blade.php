@extends('admin.layouts.master')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Kullanıcı Ayarları /</span> Hesap</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Ayarları</h5>
                    <!--Profile Photo-->
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img
                                src="{{ auth()->user()->avatar }}"
                                alt="user-avatar"
                                class="d-block w-px-100 h-px-100 rounded"
                                id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Fotoğraf Yükle</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input
                                        type="file"
                                        id="upload"
                                        name="avatar"
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
                    <!-- /Profile Photo-->
                    <hr class="my-0" />
                    <!-- Account -->
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Ad Soyad</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ auth()->user()->name }}"
                                    placeholder="Ad Soyad"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="email" class="form-label">E-Posta</label>
                                <input
                                    class="form-control"
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ auth()->user()->email }}"
                                    placeholder="mail@gmail.com"
                                />
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                            <input type="reset" class="btn btn-label-secondary p-0" value="İptal" />
                        </div>
                    </div>
                    </form>
                    <!-- /Account -->
                </div>

                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Şifre Güncelle</h5>
                    <div class="card-body">
                        <form method="POST"  action="{{ route('admin.profile.password.update') }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Mevcut Şifre</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="current_password"
                                            id="currentPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">Yeni Şifre</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            class="form-control"
                                            type="password"
                                            id="newPassword"
                                            name="password"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Yeni Şifre Tekrar</label>
                                    <div class="input-group input-group-merge">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password_confirmation"
                                            id="confirmPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <h6>Parola gereksinimleri:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimum 8 karakter uzunluğunda</li>
                                        <li class="mb-1">En az bir küçük harf karakteri</li>
                                        <li>En az bir sayı veya sembol karakteri</li>
                                    </ul>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary me-2">Güncelle</button>
                                    <button type="reset" class="btn btn-label-secondary">İptal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->

            </div>
        </div>
    </div>
    <!-- / Content -->
    <!--NOT: Sayfa içerisine eklendiğinden dolayı Asenkron Çalıştırarak JS Hatalarının önüne geçebiliriz-->
    <!--NOT: @ stack() ile belirtilen alana script dosyalarını gönderebilmek için push() methodunu kullanıyoruz.-->
    @push('scripts')
        <script async src="{{ asset('admin/assets/js/pages-account-settings-account.js') }}"></script>
        <script>
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
    @endpush
@endsection
