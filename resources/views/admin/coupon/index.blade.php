@extends('admin.layouts.master');
@push('css')
    <style>
        .btn-group > .btn:not(:last-child):not(.dropdown-toggle), .btn-group > .btn.dropdown-toggle-split:first-child, .btn-group > .btn-group:not(:last-child) > .btn {
            border-top-right-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Kuponlar</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                    <a href="{{ route('admin.coupon.create') }}" type="button" class="btn btn-primary waves-effect waves-light fw-medium">
                        <span class="ti-xs ti ti-plus me-1"></span>Kupon Ekle
                    </a>
                </div>
                <div class="card">{{ $dataTable->table() }}</div>
            </div>
            <!-- /Media -->
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
