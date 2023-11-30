@extends('admin.layouts.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Kategori Düzenle</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                </div>
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Category -->
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="categoryName" class="form-label">Kategori Adı</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="categoryName"
                                    name="name"
                                    value="{{ $category->name }}"
                                    placeholder="Kategori Adı Giriniz"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="categorySlug" class="form-label">Slug</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="categorySlug"
                                    name="slug"
                                    value="{{ $category->slug }}"
                                    placeholder="URL Uzantısını Giriniz"
                                    autofocus
                                />
                                <small>Boş Bırakırsanız Otomatik Oluşturacaktır</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="select" class="form-label">Anasayfada Göster/Gizle</label>
                                <select name="show_at_home" id="select" class="form-select">
                                    <option @selected($category->show_at_home === 1) value="1">Aktif</option>
                                    <option @selected($category->show_at_home === 0) value="0">Pasif</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="select" class="form-label">Durum</label>
                                <select name="status" id="select" class="form-select">
                                    <option @selected($category->status === 1) value="1">Aktif</option>
                                    <option @selected($category->status === 0) value="0">Pasif</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input type="submit" class="btn btn-primary me-2 p-0" style="color: #7367f0" value="Güncelle" />
                            <a href="{{ route('admin.category.index') }}" class="btn btn-label-secondary">İptal</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /Media -->
        </div>
    </div>
@endsection
