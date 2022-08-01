<?php

namespace App\DataTables;

use App\Models\MeterControlLogsDatatable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MeterControlLogsDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'metercontrollogsdatatables.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\MeterControlLogsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MeterControlLogsDatatable $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('metercontrollogsdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('slug'),
            Column::make('desc'),
            Column::make('requested_at'),
            Column::make('action_at'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
//            Column::computed('action')
//                ->exportable(false)
//                ->printable(false)
//                ->width(60)
//                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
//    protected function filename()
//    {
//        return 'MeterControlLogsDatatables_' . date('YmdHis');
//    }
}
