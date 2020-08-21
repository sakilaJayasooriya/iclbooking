<?php

namespace App\DataTables;

use App\Models\TopDestination;
use Yajra\Datatables\Services\DataTable;

class TopDestinationDataTable extends DataTable
{
    protected $exportColumns = ['title', 'image'];

    public function ajax()
    {
        $topDestinations = $this->query();

        return $this->datatables
            ->of($topDestinations)
            ->addColumn('image', function ($topDestinations) {
                return '<img src="' . $topDestinations->image_url . '" width="200" height="100">';
            })
            ->addColumn('action', function ($topDestinations) {
                return '<a target="_blank" href="' . url('admin/settings/edit-top-destinations/' . $topDestinations->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a href="' . url('admin/settings/delete-top-destinations/' . $topDestinations->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('title', function ($topDestinations) {
                return '<a target="_blank" href="' . url('admin/settings/edit-top-destinations/' . $topDestinations->id) . '">' . $topDestinations->title . '</a>';
            })
            ->addColumn('description', function ($topDestinations) {
                if($topDestinations->descripion!=null){
                    $des='<p>' .substr($topDestinations->descripion,0,20). '.......</p>';
                }
                else{
                    $des='<p>Empty</p>';
                }
                return $des;
            })
            ->make(true);
    }
    public function query()
    {
        $topDestinations = TopDestination::select();
        return $this->applyScopes($topDestinations);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->columns([
            'title',
            'image',
        ])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
        ->addColumn(['data' => 'description', 'name' => 'properties.description', 'title' => 'Description'])
        ->parameters([
            'dom' => 'lBfrtip',
            'buttons' => [],
            'pageLength' => \Session::get('row_per_page'),
        ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'topdestinationdatatables_' . time();
    }
}
