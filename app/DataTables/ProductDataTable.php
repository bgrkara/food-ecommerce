<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'product.action')
            ->addColumn('price', function ($query){
                return  currencyPosition($query->price);
            })
            ->addColumn('offer_price' ,function ($query){
                return  currencyPosition($query->offer_price);
            })
            ->addColumn('thumb_image', function ($query){
                return '<img src="'.asset($query->thumb_image).'" class="d-block h-px-100 w-px-100 rounded">';
            })
            ->addColumn('action', function ($query){
                $edit = '<a href="'.route('admin.product.edit', $query->id).'" type="button" class="btn btn-sm btn-icon"><i class="ti ti-edit"></i></a>';

                $delete = '<a href="'.route('admin.product.destroy', $query->id).'" type="button" id="confirm-color" class="btn btn-sm btn-icon delete-item delete-record"><i class="ti ti-trash"></i></a>';
                $more = '<button class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical me-2"></i></button>
                         <div class="dropdown-menu dropdown-menu-end m-0" style="">
                         <a href="'.route('admin.product-gallery.show-index', $query->id).'" class="dropdown-item">Ürün Galerisi</a>
                         <a href="'.route('admin.product-size.show-index', $query->id).'" class="dropdown-item">Ürün Varyantları</a>
                         </div>';
                return $edit.$delete.$more;
            })

            ->addColumn('status', function ($query){
                return ($query->status === 1) ? '<div class="badge bg-gradient-success ms-auto">Aktif</div>' : '<div class="badge bg-gradient-danger ms-auto">Pasif</div>';
            })
            ->addColumn('show_at_home', function ($query){
                return ($query->show_at_home === 1) ? '<div class="badge bg-gradient-primary ms-auto">Gösterildi</div>' : '<div class="badge bg-gradient-warning ms-auto">Gizlendi</div>';
            })
            ->rawColumns(['action', 'price', 'thumb_image', 'offer_price', 'status','show_at_home'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
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
            Column::make('thumb_image')->title('Ürün Görseli'),
            Column::make('name')->title('Ürün Adı'),
            Column::make('price')->title('Ürün Fiyatı'),
            Column::make('offer_price')->title('İndirimli Fiyat'),
            Column::make('show_at_home')->title('Anasayfa Gösterimi'),
            Column::make('status')->title('Durum'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(100)
                ->title('İşlemler')
                ->addClass('text-center')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}
