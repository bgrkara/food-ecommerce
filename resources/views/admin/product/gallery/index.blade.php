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
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Ürün Galerisi / {{ ucwords($product->name) }}</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Tüm Ürün Görselleri</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                            @forelse($images as $image)
                                <div class="col-md-4 col-sm-6 col-lg-2 mb-3">
                                    <div class="card h-100 justify-content-between">
                                        <img class="card-img-top" src="{{ $image->image }}" alt="Product Gallery Image">
                                        <div class="d-flex align-items-center justify-content-center mt-3 mb-2">
                                            <a href="{{ route('admin.product-gallery.destroy', $image->id) }}" type="button" id="confirm-color" class="btn btn-label-danger btn-sm waves-effect delete-item delete-record"><i class="ti ti-x"></i>&nbsp;Görseli Kaldır</a>
                                        </div>
                                    </div>
                                </div>
                        @empty
                            <span class="note-image text-center"><i class="ti ti-ban ti-xs"></i>&nbsp;ÜRÜN GÖRSELİ BULUNAMADI</span>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Product Image Upload -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title">Görsel Ekle</h5>
                    <span class="note-image">NOT: Görsel Boyutlarının 600X500 olmasına Dikkat Ediniz</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.product-gallery.store') }}" method="POST" enctype="multipart/form-data" class="dropzone" id="galleryAdd">
                        @csrf
                        <div>
                            <label for="formGallery" class="form-label">Ürün Galerisi için Görsel Yükle</label>
                            <input class="form-control" name="image" type="file" id="formGallery">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                        </div>
                    </form>
                </div>
            </div>
            <!-- Button -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mt-2">
                        <input type="submit" form="galleryAdd" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Kaydet" />
                        <a href="{{ route('admin.product.index') }}" class="btn btn-label-secondary">İptal</a>
                    </div>
                </div>
            </div>
            <!-- /Button -->
            <!-- /Media -->
        </div>
    </div>
@endsection
