@push('css')
    <style>
        @media print
        {
            .no-print, .no-print *
            {
                display: none !important;
            }
        }
        .order-detail__btn{
            color: #FFFFFF;
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #80bde5 0%, #6269e5 100%);
            line-height: 15px;
            font-size: 16px;
            text-transform: capitalize;
            padding: 10px 20px;
            max-width: 210px;
            font-weight: 500;
            box-shadow: none;
            text-shadow: none;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            border-radius: 20px;
            width: 100%;
        }
        .order-detail__btn:hover {
            color: #FFFFFF;
            background-image: linear-gradient(0deg, #522db8 0%, #1c7ce0 100%);

        }
        .order-detail-back__btn{
            color: #FFFFFF;
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #80bde5 0%, #6269e5 100%);
            line-height: 15px;
            font-size: 16px;
            text-transform: capitalize;
            padding: 10px 20px;
            max-width: 210px;
            font-weight: 500;
            box-shadow: none;
            text-shadow: none;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            border-radius: 20px;
            width: 100%;
        }
        .print__btn{
            color: #FFFFFF;
            background-color: #8BC6EC;
            background-image: linear-gradient(135deg, #80bde5 0%, #6269e5 100%);
            line-height: 15px;
            font-size: 16px;
            text-transform: capitalize;
            padding: 10px 20px;
            max-width: 210px;
            font-weight: 500;
            box-shadow: none;
            text-shadow: none;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            border-radius: 20px;
            width: 100%;
        }
        .order-detail-back__btn:hover {
            color: #FFFFFF;
            background-image: linear-gradient(0deg, #522db8 0%, #1c7ce0 100%);
        }
        .print__btn:hover {
            color: #FFFFFF;
            background-image: linear-gradient(0deg, #522db8 0%, #1c7ce0 100%);
        }
        .order-text__pending{
            color: #FBAB7E;
            background-color: #fff1e9;
            padding: 5px 10px;
            text-align: center;
        }
        .order-text__delivered{
            color: #3369e7;
            background-color: #d6e2ff;
            padding: 5px 10px;
            text-align: center;
        }
        .order-text__completed{
            color: #1bb779;
            background-color: #d0fdea;
            padding: 5px 10px;
            text-align: center;
        }
        .order-text__declined{
            color: #e4002b;
            background-color: #ffe3e8;
            padding: 5px 10px;
            text-align: center;
        }
        #orders-table tbody tr{
            line-height: 33px;
        }
        .wizard-column{
            padding: 10px 7px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .wizard-circle{
            height: 50px;
            width: 50px;
            background-image: linear-gradient(135deg, #80bde5 0%, #6269e5 100%);
            color: aliceblue;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 25px;
            z-index: 0;
        }
        .line-under{
            border: 1px solid;
            display: inline-block;
            width: 111%;
            bottom: -30px;
            position: relative;
            color: #d2d9ed;
        }
        .ps-order__title{
            color: #103178;
            font-size: 18px;
        }
        .dash-bg-white{
            padding: 20px;
        }
        .ps-invoice__content p{
            font-size: 15px;
            line-height: 14px;
            color: #475268;
        }
        .wizard-order address {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            max-width: 250px;
        }
        .active > .line-under {
            color: #2dde98;
        }
        .active > .wizard-circle {
            background-color: #2dde98;
            background-image: none;
            color: #ffffff;
        }
        .declined > .wizard-circle{
            background-image: radial-gradient( circle farthest-corner at 14.2% 24%,  rgba(239,61,78,1) 0%, rgba(239,61,78,0.81) 51.8%, rgba(239,61,78,0.63) 84.6% );

        }
        .declined > .line-under {
            color: #f7d9dc;
        }
        .package__item{
            display: flex;
            flex-direction: column;
        }
        .package__item p {color: #3f547e;}
        .package__item > .size{
            font-size: 14px;
            color: #fd7b01;
        }
        .coupon__text{color: #fd7b01;}
        .package__item > .options{
            font-size: 14px;
            color: cadetblue;
        }
    </style>
@endpush
<div class="tab-pane dash-bg-white" id="orders">
    <!--Form-->
    <div class="col-md-12 orders-list__content">
        <div class="ps-form--review">
            <h2 class="ps-form__title mb-5">Siparişlerim</h2>
            <table class="table" id="orders-table">
                <thead>
                <tr>
                    <th scope="col">Sipariş No:</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Sipariş Durumu</th>
                    <th scope="col">Toplam Fiyat</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">#{{ $order->invoice_id }}</th>
                        <td>{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</td>
                        <td>
                            @if($order->order_status === 'pending')
                                <span class="order-text__pending">Sipariş Bekleniyor</span>
                            @elseif($order->order_status === 'delivered')
                                <span class="order-text__delivered">Sipariş Gönderildi</span>
                            @elseif($order->order_status === 'in_process')
                                <span class="order-text__completed">Sipariş Teslim Edildi</span>
                            @elseif($order->order_status === 'decline')
                                <span class="order-text__declined">Sipariş İptal Edildi</span>
                            @else
                                {{ $order->order_status }}
                            @endif

                        </td>
                        <td>{{ currencyPosition($order->grand_total) }}</td>
                        <td><a class="order-detail__btn" href="javascript:void(0)" onclick="viewInvoice('{{ $order->id }}','{{ $order->order_status }}')">Detay</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/Form-->
    @foreach($orders as $order)
        <div class="col-md-12 order-detail__content invoice_detail_{{ $order->id }}" style="display: none" >
            <a class="order-detail-back__btn no-print d-print-none" href="#"><i class="fa fa-angle-left" aria-hidden="true"></i> Geri Dön</a>
            <div class="mt-5">
                <div class="row">
                    <div class="wizard-column col-4
                    {{ in_array($order->order_status, ['pending', 'delivered', 'in_process', 'decline']) ? 'active' : '' }}">
                        <span class="line-under"></span>
                        <div class="wizard-circle"><i class="icon-alarm-check"></i></div>
                        <span class="wizard-text">Sipariş Beklemede</span>
                    </div>
                    <div class="wizard-column col-4 {{ in_array($order->order_status, ['delivered', 'in_process', 'decline']) ? 'active' : '' }}">
                        <span class="line-under"></span>
                        <div class="wizard-circle"><i class="icon-truck"></i></div>
                        <span class="wizard-text">Sipariş Yola Çıktı</span>
                    </div>
                    <div class="wizard-column col-4 {{ in_array($order->order_status, ['in_process', 'decline']) ? 'active' : '' }}">
                        <span class="line-under"></span>
                        <div class="wizard-circle"><i class="icon-bag2"></i></div>
                        <span class="wizard-text">Sipariş Teslim Edildi</span>
                    </div>
                </div>
                <div id="p-invoice__detail_{{ $order->id }}">
                    <div class="row align-items-baseline justify-content-between">
                        <div class="wizard-order">
                            <h4 class="ps-order__title mb-2 mt-5">Fatura</h4>
                            <address>Ad Soyad: {{ @$order->userAddress->first_name }} {{ @$order->userAddress->last_name }}</address>
                            <address>Adres: {{ $order->address }}</address>
                            <address>Telefon: {{ @$order->userAddress->phone }}</address>
                            <address>E-Posta: {{ @$order->userAddress->email }}</address>
                        </div>
                        <div class="ps-invoice__content">
                            <p><strong>Fatura No:</strong> {{ @$order->invoice_id }}</p>
                            <p><strong>Date:</strong> {{ date('d /m /Y', strtotime($order->created_at)) }}</p>
                            <p><strong>Ödeme Durumu:</strong> {{ @$order->payment_status }}</p>
                            <p><strong>Ödeme Metodu:</strong> {{ @$order->payment_method }}</p>
                            <p><strong>İşlem Kimliği:</strong> {{ @$order->transection_id }}</p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <table class="table" id="orders-detail-table">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Ürün Detay</th>
                                <th scope="col">Fiyat</th>
                                <th scope="col">Adet</th>
                                <th scope="col">Toplam Fiyat</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                                @php
                                    $size = json_decode($item->product_size);
                                    $options = json_decode($item->product_option);

                                    if ($item->product_size !== NULL){
                                        $size = json_decode($item->product_size);
                                        $sizePrice = json_decode($item->product_size)->price;
                                    }else{
                                        $sizePrice = 0;
                                    }
                                    if ($item->product_option !== NULL){
                                        $options = json_decode($item->product_option);
                                        $optionPrice = 0;
                                        foreach ($options as $optionItem){
                                            $optionPrice += $optionItem->price;
                                        }
                                    }else{
                                        $optionPrice= 0;
                                    }

                                    $unitPrice = $item->unit_price;
                                    $qty = $item->qty;
                                    $productTotal = ($unitPrice + $sizePrice + $optionPrice) * $qty;

                                @endphp
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td class="package__item">
                                        <p>{{ $item->product_name }}</p>
                                        @if($size !== NULL)
                                            <span class="size">{{ @$size->name }} ({{ currencyPosition(@$size->price) }})</span>
                                        @endif
                                        @if($options !== NULL)
                                            @foreach($options as $option)
                                                <span class="options">{{ @$option->name }} ({{ currencyPosition(@$option->price) }})</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ currencyPosition($item->unit_price) }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ currencyPosition($productTotal) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="package" colspan="3">
                                    Ara Toplam
                                </td>
                                <td class="qty">-</td>
                                <td class="total">
                                    {{ currencyPosition($order->subtotal) }}
                                </td>
                            </tr>
                            <tr class="coupon__text">
                                <td colspan="3">
                                    Kupon İndirim Tutarı
                                </td>
                                <td class="qty">-</td>
                                <td class="total">
                                    {{ currencyPosition($order->discount) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="package" colspan="3">
                                    Teslimat Ücreti
                                </td>
                                <td class="qty">-</td>
                                <td class="total">
                                    {{ currencyPosition($order->delivery_charge) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="package" colspan="3">
                                    Toplam Ödenen
                                </td>
                                <td class="qty">-</td>
                                <td class="total">
                                    {{ currencyPosition($order->grand_total) }}
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-end mt-5">
                    <a class="print__btn" href="javascript:void(0)" onclick="printInvoice('{{ $order->id }}')"><i class="icon-printer"></i> PDF Yazdır</a>
                </div>

            </div>
        </div>
    @endforeach

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
            $('.order-detail-back__btn').on('click', function (){
                $('.orders-list__content').fadeIn();
                $('.order-detail__content').fadeOut();
            })

        })

        function viewInvoice(id, status) {
            if(status === 'decline'){
                $('.wizard-column').addClass('declined');
            }else{
                $('.wizard-column').removeClass('declined');
            }
            $('.orders-list__content').fadeOut();
            $(".invoice_detail_" + id).fadeIn();
        }

        function printInvoice(id){
            let printContents = $('#p-invoice__detail_'+id).html();
            let printWindow = window.open('', '', 'width=600,height=600');
            printWindow.document.write(`
                    <html>
                        <link rel="stylesheet" href="{{ asset('frontend/plugins/bootstrap4/css/bootstrap.min.css') }}">
                        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
                        <body>${printContents}</body>
                    </html>
                `);
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }

    </script>
@endpush
