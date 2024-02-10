@push('css')
    <style>
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
    </style>
@endpush
<div class="tab-pane" id="orders">
    <!--Form-->
    <div class="col-md-12">
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
                        <td><a class="order-detail__btn" href="#">Detay</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
