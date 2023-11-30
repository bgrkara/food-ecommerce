@extends('admin.layouts.master')
@push('css')<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/css/slider.css') }}" />@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Slider</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                    <a href="{{ route('admin.slider.create') }}" type="button" class="btn btn-primary waves-effect waves-light fw-medium">
                        <span class="ti-xs ti ti-plus me-1"></span>Slayt Ekle
                    </a>
                </div>
                <div class="card">{{ $dataTable->table() }}</div>
            </div>
            <!-- /Media -->
        </div>
    </div>
@endsection
@push('scripts')<script src="{{ asset('admin/assets/vendor/libs/dropzone/dropzone.js') }}"></script>
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}@endpush
