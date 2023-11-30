<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'category.action')
            ->addColumn('action', function ($query){
                $edit = '<a href="'.route('admin.category.edit', $query->id).'" type="button" class="btn btn-label-primary waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti ti-edit"></i></a>';
                $delete = '<a href="'.route('admin.category.destroy', $query->id).'" type="button" id="confirm-color" class="btn btn-label-danger delete-item waves-effect me-2 mb-1 mt-1"><i class="ti-xs ti ti-trash"></i></a>';

                return $edit.$delete;
            })
            ->addColumn('status', function ($query){
                return ($query->status === 1) ? '<div class="badge bg-gradient-success rounded-pill ms-auto">Aktif</div>' : '<div class="badge bg-gradient-danger rounded-pill ms-auto">Pasif</div>';
            })
            ->addColumn('show_at_home', function ($query){
                return ($query->show_at_home === 1) ? '<div class="badge bg-gradient-primary rounded-pill ms-auto">Gösteriliyor</div>' : '<div class="badge bg-gradient-warning rounded-pill ms-auto">Gizlendi</div>';
            })
            ->rawColumns(['action', 'status','show_at_home'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('category-table')
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
            Column::make('name')->title('Kategori Adı'),
            Column::make('slug')->title('Kategori Uzantısı'),
            Column::make('status')->width(100)->title('Durum'),
            Column::make('show_at_home')->width(100)->title('Anasayfa Gösterimi'),
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
        return 'Category_' . date('YmdHis');
    }
}
