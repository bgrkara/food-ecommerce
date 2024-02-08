@extends('admin.layouts.master');
@push('css')
    <style>
        .invoice-address{
            max-width: 350px;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .ps-payment__success{
            color: #ffffff;
            background-color: #2dde98;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .ps-payment__alert{
            color: #ffffff;
            background-color: #ecb731;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .ps-payment__danger{
            color: #ffffff;
            background-color: #ed1c24;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .ps-payment__primary{
            color: #ffffff;
            background-color: #4298b5;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .prod_size{
            font-size: 13px;
            color: #005670;
        }
        .prod_opt span{
            font-size: 13px;
            display: flex;
            color: #685dd8;
        }
        .table > :not(caption) > * > *{
            font-size: 14px;
        }
        .ps-order__text{
            font-size: 17px;
            margin-right: 10px;
            color: #00205b;
            font-weight: 500;
            margin-bottom: 7px;
        }
        .ps-payment__title{
            color: #afafaf;
            padding: 0;
            margin: 0;
        }
    </style>
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Sipariş Detayı</span>
        </h4>
        <!-- Datatable -->
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                    <svg
                                        width="32"
                                        height="22"
                                        viewBox="0 0 32 22"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#7367F0" />
                                        <path
                                            opacity="0.06"
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path
                                            opacity="0.06"
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path
                                            fill-rule="evenodd"
                                            clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#7367F0" />
                                    </svg>

                                    <span class="app-brand-text fw-bold fs-4"> {{ config('settings.site_name') }} </span>
                                </div>
                                <p class="mb-2 invoice-address"><strong>Müşeri Adı :</strong> {!! @$order->userAddress->first_name .' '. @$order->userAddress->last_name !!}</p>
                                <p class="mb-2 invoice-address"><strong>Telefon :</strong> {!! @$order->userAddress->phone !!}</p>
                                <p class="mb-2 invoice-address"><strong>E-Posta :</strong> {!! @$order->userAddress->email !!}</p>
                                <address>
                                    <p class="mb-2 invoice-address"><strong>Teslimat Adresi:</strong> {!! @$order->userAddress->address !!}</p>
                                    <p class="mb-2 invoice-address"><strong>Bölge:</strong> {!! @$order->userAddress->deliveryArea->area_name !!}</p>
                                </address>
                            </div>
                            <div>
                                <h4 class="fw-medium mb-2">FATURA #{{ $order->invoice_id }}</h4>
                                <div class="mb-4">
                                    <div class="mb-2 pt-1">
                                        <strong>Ödeme Durumu: &nbsp;</strong>
                                        <span class="ps-payment__text">
                                        @if(strtoupper($order->payment_status) == 'COMPLETED')
                                                <span class="ps-payment__success">Ödendi</span>
                                            @elseif($order->payment_status === 'pending')
                                                <span class="ps-payment__alert">Ödeme Bekleniyor</span>
                                            @elseif($order->payment_status === 'delivered')
                                                <span class="ps-payment__danger">Ödeme İptal Edildi</span>
                                            @else
                                                <span class="ps-payment__text">{{ $order->payment_status }}</span>
                                            @endif
                                    </span>
                                    </div>
                                    @if(strtoupper($order->payment_status) == 'COMPLETED')
                                        <div class="mb-2 pt-1">
                                            <strong>Ödeme Tarihi:</strong>
                                            <span class="fw-medium">{{ date('d m ,Y H:i:s', strtotime($order->payment_approve_date)) }} <br>
                                    </span>
                                        </div>
                                    @endif
                                </div>
                                <div class="mb-2 pt-1">
                                    <strong>Sipariş Durumu: &nbsp;</strong>
                                    <span class="ps-payment__text">
                                        @if($order->order_status === 'delivered')
                                            <span class="ps-payment__success">Teslim Edildi</span>
                                        @elseif($order->order_status === 'pending')
                                            <span class="ps-payment__alert">Bekleniyor</span>
                                        @elseif($order->order_status === 'in_process')
                                            <span class="ps-payment__primary">Ürün Gönderildi</span>
                                        @elseif($order->order_status === 'decline')
                                            <span class="ps-payment__danger">İptal Edildi</span>
                                        @else
                                            <span class="ps-payment__text">{{ $order->order_status }}</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="pt-1">
                                    <strong>Sipariş Tarihi:</strong>
                                    <span class="fw-medium">{{ date('d m ,Y H:i:s', strtotime($order->created_at)) }} <br>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive border-top">
                        <table class="table m-0">
                            <thead>
                            <tr>
                                <th>Ürün Adı</th>
                                <th>Ürün Boyutu/ Ek Seçenekler</th>
                                <th>Ürün Fiyatı</th>
                                <th>Adet</th>
                                <th>Toplam Fiyat</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $orderItem)
                                @php
                                if ($orderItem->product_size !== NULL){
                                    $size = json_decode($orderItem->product_size);
                                    $sizePrice = json_decode($orderItem->product_size)->price;
                                }else{
                                    $sizePrice = 0;
                                }
                                if ($orderItem->product_option !== NULL){
                                    $options = json_decode($orderItem->product_option);
                                    $optionPrice = 0;
                                    foreach ($options as $optionItem){
                                        $optionPrice += $optionItem->price;
                                    }
                                }else{
                                    $optionPrice= 0;
                                }

                                $unitPrice = $orderItem->unit_price;
                                $qty = $orderItem->qty;
                                $productTotal = ($unitPrice + $sizePrice + $optionPrice) * $qty;
                                @endphp
                                <tr>
                                    <td class="text-nowrap">{!! $orderItem->product_name !!}</td>
                                    <td class="text-nowrap">
                                        @if($orderItem->product_size !== NULL)
                                            <div class="prod_size">
                                                {{ 'Boyut: '. $size->name }} ({{ currencyPosition($size->price) }})
                                            </div>
                                        @endif
                                        @if($orderItem->product_option !== NULL)
                                            <div class="prod_opt">
                                                @foreach($options as $option)
                                                    <span>{{ $option->name }} ({{ currencyPosition($option->price) }})</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ currencyPosition($orderItem->unit_price) }}</td>
                                    <td>{{ $orderItem->qty }}</td>
                                    <td>{{ currencyPosition($productTotal) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <form action="{{ route('admin.orders.status-update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="paymentStatus" class="form-label">Ödeme Durumu</label>
                                        <select class="form-select" name="payment_status" id="paymentStatus">
                                            <option @selected($order->payment_status === 'pending') value="pending">Ödeme Bekleniyor</option>
                                            <option @selected($order->payment_status === 'completed') value="completed">Ödendi</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderStatus" class="form-label">Sipariş Durumu</label>
                                        <select class="form-select" name="order_status" id="orderStatus">
                                            <option @selected($order->order_status === 'pending') value="pending">Bekleniyor</option>
                                            <option @selected($order->order_status === 'in_process') value="in_process">Ürün Gönderildi</option>
                                            <option @selected($order->order_status === 'delivered') value="delivered">Teslim Edildi</option>
                                            <option @selected($order->order_status === 'decline') value="decline">Sipariş İptal Edildi</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-primary d-grid w-100 mb-2 waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                                        <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-send ti-xs me-2"></i>Sipariş Durumu Güncelle</span>
                                    </button>
                                </form>
                            </div>
                            <div>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between pt-1">
                                        <p class="ps-payment__title">Ara Toplam : &nbsp;&nbsp;</p>
                                        <p class="ps-order__text">
                                            {{ currencyPosition($order->subtotal) }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between pt-1">
                                        <p class="ps-payment__title">Teslimat Ücreti : &nbsp;&nbsp;</p>
                                        <p class="ps-order__text">
                                            {{ currencyPosition($order->delivery_charge) }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between pt-1">
                                        <p class="ps-payment__title">İndirim Tutarı : &nbsp;&nbsp;</p>
                                        <p class="ps-order__text">
                                            {{ currencyPosition($order->discount) }}
                                        </p>
                                    </div>
                                    <div class="d-flex justify-content-between pt-1">
                                        <p class="ps-payment__title">Genel Toplam : &nbsp;&nbsp;</p>
                                        <p class="ps-order__text">
                                            {{ currencyPosition($order->grand_total) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <button
                            class="btn btn-primary d-grid w-100 mb-2"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="ti ti-send ti-xs me-2"></i>Send Invoice</span
                        >
                        </button>
                        <button class="btn btn-label-secondary d-grid w-100 mb-2">Download</button>
                        <a
                            class="btn btn-label-secondary d-grid w-100 mb-2"
                            target="_blank"
                            href="./app-invoice-print.html">
                            Print
                        </a>
                        <a href="./app-invoice-edit.html" class="btn btn-label-secondary d-grid w-100 mb-2">
                            Edit Invoice
                        </a>
                        <button
                            class="btn btn-primary d-grid w-100"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#addPaymentOffcanvas">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="ti ti-currency-dollar ti-xs me-2"></i>Add Payment</span
                        >
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
@endsection
