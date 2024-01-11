<?php

namespace App\DataTables;

use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DeliveryAreaDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'deliveryarea.action')
            ->addColumn('action', function ($query){
                $edit = '<a href="'.route('admin.delivery-area.edit', $query->id).'" type="button" class="btn btn-label-primary waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti ti-edit"></i></a>';
                $delete = '<a href="'.route('admin.delivery-area.destroy', $query->id).'" type="button" id="confirm-color" class="btn btn-label-danger delete-item waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti-trash"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('delivery_fee', function ($query){
                return currencyPosition($query->delivery_fee);
            })
            ->addColumn('min_delivery_time', function ($query){
                return '<div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0"><span class="badge badge-dot bg-primary me-1"></span> ' . $query->min_delivery_time . ' Dakika</div>';
            })
            ->addColumn('max_delivery_time', function ($query){
                return '<div class="d-flex align-items-center lh-1 me-3 mb-3 mb-sm-0"><span class="badge badge-dot bg-danger me-1"></span> ' . $query->max_delivery_time . ' Dakika</div>';
            })
            ->addColumn('status', function ($query){
                return ($query->status === 1) ? '<div class="badge bg-gradient-success rounded-pill ms-auto">Aktif</div>' : '<div class="badge bg-gradient-danger rounded-pill ms-auto">Pasif</div>';
            })
            ->rawColumns(['action', 'status', 'min_delivery_time', 'max_delivery_time'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(DeliveryArea $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('deliveryarea-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
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
            Column::make('area_name')->title('Teslimat Alanı Adı'),
            Column::make('delivery_fee')->title('Teslimat Ücreti'),
            Column::make('min_delivery_time')->title('Min. Teslimat Süresi'),
            Column::make('max_delivery_time')->title('Max. Teslimat Süresi'),
            Column::make('status')->title('Durum'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'DeliveryArea_' . date('YmdHis');
    }
}
