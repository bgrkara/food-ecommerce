<div class="tab-pane active" id="userinfo">
    <!--Form-->
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4 dash-order dash-bg-white">
                <div class="ps-section--categories mt-4">
                    <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-all.svg')}}" alt></a><a class="ps-categories__name" href="#">Toplam Sipariş</a></div>
                </div>
            </div>
            <div class="col-md-4 dash-order dash-bg-white">
                <div class="ps-section--categories mt-4">
                    <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-approve.svg')}}" alt></a><a class="ps-categories__name" href="#">Tamamlanan</a></div>
                </div>
            </div>
            <div class="col-md-4 dash-order dash-bg-white">
                <div class="ps-section--categories mt-4">
                    <div class="ps-categories__item"><a class="ps-categories__link" href="#"><img src="{{ asset('frontend/img/branch/basket-cancel.svg')}}" alt></a><a class="ps-categories__name" href="#">İptal Edilen</a></div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')
            <div class="ps-form--review">
                <h2 class="ps-form__title mb-5">Kişisel Bilgiler</h2>
                <div class="ps-form__group">
                    <label class="ps-form__label">Ad Soyad *</label>
                    <input id="name" name="name" placeholder="Ad Soyad" class="form-control ps-form__input" type="text" required autofocus value="{{ auth()->user()->name }}">
                </div>
                <div class="ps-form__group">
                    <label class="ps-form__label">E-posta Adresi *</label>
                    <input name="email" placeholder="E-Posta Adresiniz" class="form-control ps-form__input" type="email" required autofocus value="{{ auth()->user()->email }}">
                </div>
                <div class="ps-form__submit mt-4">
                    <button class="ps-btn ps-btn--warning">Kaydet</button>
                </div>
            </div>
        </form>
    </div>
    <!--/Form-->
</div>
