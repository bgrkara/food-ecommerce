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
        .address-cancel-btn{
            border: none;
            padding: 4px 22px;
            border-radius: 25px;
            margin-top: 10px;
            color: #ffffff;
            background-color: #999da3;
            cursor: pointer;
        }
        .address-cancel-btn:hover{background-color: #cbcccd;}
        .mb-80{
            margin-bottom: 80px;
        }
        .address-submit-btn:hover{background-color: #e1ca91;}
        .ps-form__submit > a:hover{color: #103178 !important;}
        .type-check-column{
            padding: 10px 5px;
            border-radius: 10px;
            border: 1px solid;
            max-width: 100px;
            background-color: #f0f2f5;
        }
        .form-check .form-check-label::before {
            background: #afc0db !important;
            border-radius: 50px !important;
        }
        .ps-checkout .form-check label {
            font-size: 16px !important;
        }
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
                        <label class="add_address_btn address-create" for="ship-address"><i class="fa fa-map-marker" aria-hidden="true"></i> Adres Ekle</label>
                    </div>
                </div>
            </div>
            <div class="ps-checkout mb-80">
                <div class="col-12 ps-hidden" data-for="ship-address">
                    <form action="{{ route('address.store') }}" method="POST">
                        @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="ps-checkout__group">
                                <label for="select-area" class="ps-checkout__label">Şehir/Bölge Seçiniz *</label>
                                <select class="ps-input" name="area" id="select-area">
                                    <option value="">Şehir/Bölge Seç</option>
                                    @foreach($deliveryAreas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                                <input class="ps-input" name="phone" type="text">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">E-Posta Adresi *</label>
                                <input class="ps-input" name="email" type="text">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="ps-checkout__group">
                                <label class="ps-checkout__label">Teslimat Adresiniz</label>
                                <textarea class="ps-textarea" name="address" rows="3" placeholder="Teslimat Adresinizi Giriniz"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-40">
                            <div class="row">
                                <div class="col-6 col-md-2">
                                    <div class="form-check type-check-column">
                                        <input class="form-check-input" type="radio" name="type" id="type-home" value="home">
                                        <label class="form-check-label" for="type-home"><i class="fa fa-home" aria-hidden="true"></i> Ev</label>
                                    </div>
                                </div>
                                <div class="col-6 col-md-2">
                                    <div class="form-check type-check-column">
                                        <input class="form-check-input" type="radio" name="type" id="type-office" value="office">
                                        <label class="form-check-label" for="type-office"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ps-form__submit">
                            <button type="submit" class="address-submit-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adres Ekle</button>
                            <a href="javascript:void(0);" id="ship-address-create-cancel" class="address-cancel-btn"><i class="fa fa-undo" aria-hidden="true"></i> İptal</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            @foreach($userAddresses as $address)
                <div class="ps-checkout mb-80">
                    <div class="col-12 ps-hidden edit_section_{{ $address->id }}" id="address-edit" data-for="ship-address-edit">
                        <h3 class="ps-form__title mb-5">Adres Bilgileri Düzenle</h3>
                        <form action="{{ route('address.update', $address->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <label for="select-area" class="ps-checkout__label">Şehir/Bölge Seçiniz *</label>
                                        <select class="ps-input" name="area" id="select-area">
                                            <option value="">Şehir/Bölge Seç</option>
                                            @foreach($deliveryAreas as $area)
                                                <option @selected($address->delivery_area_id === $area->id) value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Adınız *</label>
                                        <input class="ps-input" name="first_name" type="text" value="{{ $address->first_name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Soyadınız *</label>
                                        <input class="ps-input" name="last_name" type="text" value="{{ $address->last_name }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Telefon Numarası *</label>
                                        <input class="ps-input" name="phone" type="text" value="{{ $address->phone }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">E-Posta Adresi *</label>
                                        <input class="ps-input" name="email" type="text" value="{{ $address->email }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="ps-checkout__group">
                                        <label class="ps-checkout__label">Teslimat Adresiniz</label>
                                        <textarea class="ps-textarea" name="address" rows="3" placeholder="Teslimat Adresinizi Giriniz">{!! $address->address !!}</textarea>
                                    </div>
                                </div>
                                <div class="col-12 mb-40">
                                    <div class="row">
                                        <div class="col-6 col-md-2">
                                            <div class="form-check type-check-column">
                                                <input class="form-check-input" type="radio" name="type" id="home_update_{{ $address->id }}" @checked($address->type === 'home') value="home">
                                                <label class="form-check-label" for="home_update_{{ $address->id }}"><i class="fa fa-home" aria-hidden="true"></i> Ev</label>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-2">
                                            <div class="form-check type-check-column">
                                                <input class="form-check-input" type="radio" name="type" id="office_update_{{ $address->id }}" @checked($address->type === 'office') value="office">
                                                <label class="form-check-label" for="office_update_{{ $address->id }}"><i class="fa fa-building-o" aria-hidden="true"></i> Ofis</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ps-form__submit">
                                    <button type="submit" class="address-submit-btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Adres Düzenle</button>
                                    <a href="javascript:void(0);" id="ship-address-edit-cancel" class="address-cancel-btn show-edit-section" data-class="edit_section_{{ $address->id }}"><i class="fa fa-undo" aria-hidden="true"></i> İptal</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row">
                @foreach($userAddresses as $address)
                    <div class="col-md-6 dash-order address-list dash-bg-white">
                        <div class="row title-head m-4">
                            <div class="head-column">
                                <a class="head-location" href="javascript:void(0);">
                                    @if($address->type === 'home')
                                        <i class="fa fa-home" aria-hidden="true"></i> Ev
                                    @else
                                        <i class="fa fa-building-o" aria-hidden="true"></i> Ofis
                                    @endif
                                </a>
                            </div>
                            <div class="head-column">
                                <a class="head-action-btn bg-edit show-edit-section" data-class="edit_section_{{ $address->id }}" href="javascript:void(0);" id="ship-address-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <a class="head-action-btn bg-remove delete-item" href="{{ route('address.destroy', $address->id) }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        <div class="ps-section--categories mt-4">
                            <div class="ps-categories__item">
                                <div class="ps-checkout__row ps-product">
                                    <p>TESLİMAT ADRESİ </p>
                                    <div class="ps-product__name">{{ $address->address }} - {{ $address->deliveryArea?->area_name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--/Form-->
</div>
@push('scripts')
    <script>
        $(document).ready(function (){
            $('.address-create').on('click', function (){
                $( "#address-edit" ).css('display', 'none');
            })

            $('.show-edit-section').on('click', function (){
                let className = $(this).data('class');
                $('.'+className).slideToggle();
            })

        })

    </script>
@endpush
