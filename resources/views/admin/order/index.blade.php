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
            <span class="text-muted fw-light">Siparişler</span>
        </h4>
        <!-- Datatable -->
        <div class="row">
            <!-- Media -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title"></h5>
                </div>
                <div class="card">{{ $dataTable->table() }}</div>
            </div>
            <!-- /Media -->
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalTitle">Sipariş Durumu Güncelle</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="" method="POST" class="order_status_form">
                            @csrf
                            @method('PUT')
                            <div class="d-print-none">
                                <div class="mb-3">
                                    <label for="paymentStatus" class="form-label">Ödeme Durumu</label>
                                    <select class="form-select payment_status" name="payment_status" id="paymentStatus">
                                        <option value="pending">Ödeme Bekleniyor</option>
                                        <option value="completed">Ödendi</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="orderStatus" class="form-label">Sipariş Durumu</label>
                                    <select class="form-select order_status" name="order_status" id="orderStatus">
                                        <option  value="pending">Bekleniyor</option>
                                        <option  value="in_process">Ürün Gönderildi</option>
                                        <option  value="delivered">Teslim Edildi</option>
                                        <option  value="decline">Sipariş İptal Edildi</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary submit_btn"><span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Sipariş Durumu Güncelle</span></button>
                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                        İptal
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function (){
            var orderId;
            $(document).on('click', '.order_status_btn', function (){
                let id = $(this).data('id');
                orderId = id; // Order Id Global
                let paymentStatus = $('.payment_status option');
                let orderStatus = $('.order_status option');

                $.ajax({
                    method: 'GET',
                    url: '{{ route("admin.orders.status", ":id") }}'.replace(":id", id),
                    beforeSend: function (){
                        $('.submit_btn').prop('disable', true);
                    },
                    success: function (response){
                        paymentStatus.each(function (){
                            if($(this).val() === response.payment_status){
                                $(this).attr('selected', 'selected');
                            }
                        })
                        orderStatus.each(function (){
                            if($(this).val() === response.order_status){
                                $(this).attr('selected', 'selected');
                            }
                        })
                        $('.submit_btn').prop('disable', false);
                    },
                    error: function (xhr, status, error){

                    },
                    complete: function (){

                    }
                })
            })

            $('.order_status_form').on('submit', function (e){
                e.preventDefault();
                let formContent = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    url: '{{ route("admin.orders.status-update", ":id") }}'.replace(":id", orderId),
                    data: formContent,
                    success: function (response){
                        setTimeout(function (){
                            $('#orderModal').modal('hide');
                            $('#order-table').DataTable().draw();
                        },500)

                        toastr.success(response.message);
                    },
                    error: function (xhr, status, error){
                        toastr.error(xhr.responseJSON.message);
                    }
                })

            })

        })
    </script>
@endpush
