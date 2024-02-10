<?php

namespace App\DataTables;

use App\Models\Order;
use App\Models\PendingOrder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PendingOrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'order.action')
            ->addColumn('action', function ($query){
                $view = '<a href="'.route('admin.orders.show', $query->id).'" type="button" class="btn btn-label-primary waves-effect me-2 mb-1 mt-1" style="padding: 10px !important;"><i class="ti-xs ti ti ti-eye"></i></a>';
                $status = '<a href="javascript:void(0);" type="button" class="btn btn-label-warning waves-effect me-2 mb-1 mt-1 order_status_btn" data-bs-toggle="modal" data-bs-target="#orderModal" data-id="'. $query->id .'" style="padding: 10px !important;"><i class="ti-xs ti ti ti-truck-delivery"></i></a>';
                $delete = '<a href="'.route('admin.orders.destroy', $query->id).'" type="button" id="confirm-color" class="btn btn-label-danger delete-item waves-effect me-2 mb-1 mt-1" style="padding: 10px !important;"><i class="ti-xs ti ti-trash"></i></a>';

                return $view.$status.$delete;
            })
            ->addColumn('user_name', function ($query){
                return $query->user?->name;
            })
            ->addColumn('order_status', function ($query){
                if($query->order_status === "delivered"){
                    return '<div class="badge bg-gradient-success rounded-pill ms-auto">Sipariş Teslim Edildi</div>';
                }elseif($query->order_status === "decline"){
                    return '<div class="badge bg-gradient-danger rounded-pill ms-auto">Sipariş İptal Edildi</div>';
                }elseif($query->order_status === "pending"){
                    return '<div class="badge bg-gradient-warning rounded-pill ms-auto">Bekleniyor</div>';
                }elseif($query->order_status === "in_process"){
                    return '<div class="badge bg-gradient-warning rounded-pill ms-auto">Sipariş Gönderildi</div>';
                }
                else{
                    return '<div class="badge bg-gradient-primary rounded-pill ms-auto">'. $query->order_status .'</div>';
                }
            })
            ->addColumn('payment_status', function ($query){
                if(strtoupper($query->payment_status) == "COMPLETED"){
                    return '<div class="badge bg-gradient-success rounded-pill ms-auto">Ödendi</div>';
                }elseif($query->payment_status === "pending"){
                    return '<div class="badge bg-gradient-warning rounded-pill ms-auto">Ödeme Bekleniyor</div>';
                }elseif($query->payment_status === "delivered"){
                    return '<div class="badge bg-gradient-danger rounded-pill ms-auto">Ödeme İptal Edildi</div>';
                }
                else{
                    return '<div class="badge bg-gradient-primary rounded-pill ms-auto">'. $query->payment_status .'</div>';
                }
            })
            ->addColumn('product_qty', function ($query){
                return '<div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0"><span class="badge badge-dot bg-primary me-1"></span>'. $query->product_qty .'</div>';
            })
            ->addColumn('grand_total', function ($query){
                return $query->grand_total . ' ' . strtoupper($query->currency_name);
            })
            ->addColumn('created_at', function ($query){
                return date('d/m/Y H:i:s', strtotime($query->created_at));
            })
            ->rawColumns(['action', 'order_status', 'payment_status', 'product_qty', 'grand_total'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->where('order_status', 'pending')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pendingorder-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('invoice_id')->title('Fatura Kimliği')->width(200),
            Column::make('user_name')->title('Müşteri Adı'),
            Column::make('product_qty')->title('Ürün Adedi'),
            Column::make('grand_total')->title('Toplam Tutar'),
            Column::make('order_status')->title('Sipariş Durumu'),
            Column::make('payment_status')->title('Ödeme Durumu'),
            Column::make('created_at')->title('Sipariş Zamanı'),
            Column::computed('action')->title('Durum')
                ->exportable(false)
                ->printable(false)
                ->width(160)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PendingOrder_' . date('YmdHis');
    }
}
