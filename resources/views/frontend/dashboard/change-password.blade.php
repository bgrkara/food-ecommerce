<div class="tab-pane" id="pass">
    <!--Form-->
    <div class="col-md-12">
        <form method="POST" action="{{ route('profile.password.update') }}">
            @csrf
            @method('PUT')
            <div class="ps-form--review">
                <h2 class="ps-form__title mb-5">Şifre İşlemleri</h2>
                <div class="row">
                    <div class="ps-form__group col-md-6">
                        <label class="ps-form__label">Mevcut Şifre *</label>
                        <input name="current_password" type="password" placeholder="Mevcut Şifreyi Giriniz" class="form-control ps-form__input" required autofocus value="">
                    </div>
                </div>
                <div class="row">
                    <div class="ps-form__group col-md-6">
                        <label class="ps-form__label">Yeni Şifre *</label>
                        <input name="password" type="password" placeholder="Yeni Şifre Giriniz" class="form-control ps-form__input" required autofocus value="">
                    </div>
                    <div class="ps-form__group col-md-6">
                        <label class="ps-form__label">Şifreyi Onayla *</label>
                        <input name="password_confirmation" type="password" placeholder="Yeni Şifreyi Tekrar Giriniz" class="form-control ps-form__input" required autofocus value="">
                    </div>
                </div>
                <div class="ps-form__submit mt-4">
                    <button class="ps-btn ps-btn--warning">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
    <!--/Form-->
</div>
