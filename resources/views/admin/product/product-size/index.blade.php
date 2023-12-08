@extends('admin.layouts.master');
@push('css')
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
    <style>
        .card-title {
            font-size: medium !important;
            color: #433c8f !important;
            font-weight: 300;
        }
        .form-label{
            min-width: 100%;
        }
        .note-image{
            margin-bottom: 0.25rem;
            font-size: 0.8125rem;
            color: #433c8f !important;
            opacity: .5;
        }
        .form-control::-webkit-inner-spin-button,
        .form-control::-webkit-outer-spin-button {
            -webkit-appearance: none;   margin: 0;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Ürün Varyantları / {{ ucwords($product->name) }}</span>
        </h4>
        <!-- Product Size -->
        <div class="row">
            <!-- Product Size -->
            <div class="col-md-6">
                <div class="row m-1">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ürün Boyut Adı</th>
                                        <th>Fiyatı</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @forelse($sizes as $size)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td><i class="ti ti-pizza ti-md text-danger me-3"></i> <span class="fw-medium">{{ $size->name }}</span></td>
                                            <td>{{ $size->price }} ₺</td>
                                            <td width="50" class="text-center"><a href="{{ route('admin.product-size.destroy', $size->id) }}" type="button" id="confirm-color" class="btn btn-sm btn-icon delete-item text-danger delete-record"><i class="ti ti-trash"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td colspan="3"><span class="note-image text-center"><i class="ti ti-ban ti-xs"></i>&nbsp;ÜRÜN VARYANTI BULUNAMADI</span></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Product Image Upload -->
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 card-title">Ürün Boyutu Ekle</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-size.store') }}" method="POST" id="productSizeAdd">
                                @csrf
                                <div class="row">
                                    <!-- ProductSizeName -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="productSizeName" class="form-label">Ürün Boyut Adı</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="productSizeName"
                                                name="name"
                                                value="{{ old('name') }}"
                                                placeholder="Ürün Boyut Adı Giriniz"
                                                autofocus
                                            />
                                        </div>
                                    </div>
                                    <!-- price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Ürün Fiyatı</label>
                                            <div class="input-group">
                                                <span class="input-group-text">TL</span>
                                                <input type="number" name="price" id="productPrice" value="{{ old('price') }}" class="form-control form-control-sm" placeholder="100" aria-label="Tutar">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mt-2">
                                <input type="submit" form="productSizeAdd" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                                <a href="{{ route('admin.product.index') }}" class="btn btn-label-secondary">İptal</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Button -->
                    <!-- /Media -->
                </div>
            </div>
            <!-- Product Option -->
            <div class="col-md-6">
                <div class="row m-1">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive text-nowrap">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Ürün Seçenek Adı</th>
                                        <th>Fiyatı</th>
                                        <th>İşlemler</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                    @forelse($options as $option)
                                        <tr>
                                            <td>{{ ++$loop->index }}</td>
                                            <td><i class="ti ti-basket ti-md text-primary me-3"></i> <span class="fw-medium">{{ $option->name }}</span></td>
                                            <td>{{ $option->price }} ₺</td>
                                            <td class="text-center" width="50"><a href="{{ route('admin.product-option.destroy', $option->id) }}" type="button" id="confirm-color" class="btn btn-sm btn-icon delete-item text-danger delete-record"><i class="ti ti-trash"></i></a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td></td>
                                            <td colspan="3"><span class="note-image text-center"><i class="ti ti-ban ti-xs"></i>&nbsp;ÜRÜN VARYANTI BULUNAMADI</span></td>
                                            <td></td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 card-title">Ürün Opsiyonu Ekle</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-option.store') }}" method="POST" id="productOptionAdd">
                                @csrf
                                <div class="row">
                                    <!-- ProductSizeName -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="productSizeName" class="form-label">Ürün Boyut Adı</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="productSizeName"
                                                name="name"
                                                value="{{ old('name') }}"
                                                placeholder="Ürün Boyut Adı Giriniz"
                                                autofocus
                                            />
                                        </div>
                                    </div>
                                    <!-- price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="productPrice" class="form-label">Ürün Fiyatı</label>
                                            <div class="input-group">
                                                <span class="input-group-text">TL</span>
                                                <input type="number" name="price" id="productPrice" value="{{ old('price') }}" class="form-control form-control-sm" placeholder="100" aria-label="Tutar">
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Button -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mt-2">
                                <input type="submit" form="productOptionAdd" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                                <a href="{{ route('admin.product.index') }}" class="btn btn-label-secondary">İptal</a>
                            </div>
                        </div>
                    </div>
                    <!-- /Button -->
                    <!-- /Media -->
                </div>
            </div>
        </div>

    </div>
@endsection
