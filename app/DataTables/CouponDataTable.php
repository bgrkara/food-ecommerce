<?php

namespace App\DataTables;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CouponDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'coupon.action')
            ->addColumn('action', function ($query){
                $edit = '<a href="'.route('admin.coupon.edit', $query->id).'" type="button" class="btn btn-label-primary waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti ti-edit"></i></a>';
                $delete = '<a href="'.route('admin.coupon.destroy', $query->id).'" type="button" id="confirm-color" class="btn btn-label-danger delete-item waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti-trash"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('status', function ($query){
                return ($query->status === 1) ? '<div class="badge bg-gradient-success rounded-pill ms-auto">Aktif</div>' : '<div class="badge bg-gradient-danger rounded-pill ms-auto">Pasif</div>';
            })
            ->addColumn('discount_type', function ($query){
                return ($query->discount_type === 'percent') ? '<div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0"><span class="badge badge-dot bg-primary me-1"></span> Yüzde İndirim (%)</div>' : '<div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0"><span class="badge badge-dot bg-warning me-1"></span> Tutar İndirim (₺)</div>';
            })
            ->addColumn('expire_date', function ($query){
                return date('d/m/Y', strtotime($query->expire_date));
            })
            ->rawColumns(['action', 'status', 'discount_type', 'expire_date'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Coupon $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('coupon-table')
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
            Column::make('name')->title('Kupon Adı')->width(200),
            Column::make('code')->title('Kupon Kodu'),
            Column::make('quantity')->title('Miktar'),
            Column::make('discount_type')->title('İndirim Türü')->width(130),
            Column::make('discount')->title('İndirim Oranı'),
            Column::make('expire_date')->title('Sona Erme Tarihi'),
            Column::make('status')->title('Durum'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->title('İşlemler')
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Coupon_' . date('YmdHis');
    }
}
