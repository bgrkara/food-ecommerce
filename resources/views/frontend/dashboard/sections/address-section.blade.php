@push('css')
    <style>
        .title-head{
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }
        .ps-btn i {
            font-size: 13px !important;
        }
        .head-action-btn{
            padding: 4px 9px;
            border-radius: 6px;
        }
        .head-action-btn:hover{
            color: #103178 !important;
        }
        .add_address_btn{
            padding: 5px 20px;
            background-color: #FD8D27;
            color: #FFFFFF;
            border-radius: 25px;
        }
        .add_address_btn:hover{background-color: #e1ca91;}
        .bg-edit{background-color: #beebd9;}
        .bg-edit:hover{background-color: #d8f3e8;}
        .bg-remove{background-color: #ffb2b5;}
        .bg-remove:hover{background-color: #eddbdb;}
        .head-location{
            border: 1px solid;
            padding: 2px 11px;
            border-radius: 6px;
            cursor: default;
        }
        .address-submit-btn{
            border: none;
            padding: 4px 22px;
            border-radius: 25px;
            margin-top: 10px;
            color: #ffffff;
            background-color: #FD8D27;
            cursor: pointer;
        }
        .mb-80{
            margin-bottom: 80px;
        }
        .address-submit-btn:hover{background-color: #e1ca91;}
        .ps-form__submit > a:hover{color: #103178 !important;}
    </style>
@endpush
<div class="tab-pane" id="address">
    <!--Form-->
    <div class="col-md-12">
        <div class="ps-form--review" id="address_list_column">
            <div class="row title-head">
                <h2 class="ps-form__title mb-5">Adres Bilgileri</h2>
                <div class="ps-checkout__group">
                    <div class="form-check">
                        <input class="form-check-input" id="ship-address">
                        <label class="add_address_btn" for="ship-address"><i class="fa fa-map-marker" aria-hidden="true"></i> Adres Ekle</label>
                    </div>
                </div>
            </div>
            <div class="ps-checkout mb-80">
                <div class="col-12 ps-hidden" data-for="ship-address">
                    <form action="#" method="post">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Adınız *</label>
                                <input class="ps-input" name="first_name" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Soyadınız *</label>
                                <input class="ps-input" name="last_name" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Telefon Numarası *</label>
                                <input class="ps-input" name="first_name" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">E-Posta Adresi *</label>
                                <input class="ps-input" name="first_name" type="text">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Şehir/Bölge Seçiniz *</label>
                                <select class="ps-input" name="" id="select_checkout_country">
                                    <option value="">Şehir/Bölge Seç</option>
                                    <option value="">Ankara</option>
                                    <option value="">İstanbul</option>
                                    <option value="">İzmir</option>
                                    <option value="">Fethiye</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Teslimat Adresiniz</label>
                                <textarea class="ps-textarea" rows="3" placeholder="Teslimat Adresinizi Giriniz"></textarea>
                            </div>
                        </div>
                        <div class="ps-form__submit">
                            <button type="submit" class="address-submit-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adres Ekle</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 dash-order dash-bg-white">
                    <div class="row title-head m-4">
                        <div class="head-column">
                            <a class="head-location" href="javascript:void(0);"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</a>
                        </div>
                        <div class="head-column">
                            <a class="head-action-btn bg-edit" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="head-action-btn bg-remove" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="ps-section--categories mt-4">
                        <div class="ps-categories__item">
                            <div class="ps-checkout__row ps-product">
                                <p>TESLİMAT ADRESİ </p>
                                <div class="ps-product__name">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 dash-order dash-bg-white">
                    <div class="row title-head m-4">
                        <div class="head-column">
                            <a class="head-location" href="javascript:void(0);"><i class="fa fa-home" aria-hidden="true"></i> Ev</a>
                        </div>
                        <div class="head-column">
                            <a class="head-action-btn bg-edit" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            <a class="head-action-btn bg-remove" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <div class="ps-section--categories mt-4">
                        <div class="ps-categories__item">
                            <div class="ps-checkout__row ps-product">
                                <p>TESLİMAT ADRESİ </p>
                                <div class="ps-product__name">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/Form-->
</div>
@push('scripts')
    <script>
        $(document).ready(function (){

            $('#add_address').on('click', function (){
                $('#address_list_column').css('display', 'none');
                $('#address_form_column').css('display', 'block');
            })
            $('#address_form_cancel').on('click', function (){
                $('#address_list_column').css('display', 'block');
                $('#address_form_column').css('display', 'none');
            })

        })

    </script>
@endpush
