<?php

namespace App\DataTables;

use App\Models\Properties;
use Yajra\Datatables\Services\DataTable;
use Request;
use App\Http\Helpers\Common;

class PropertyDataTable extends DataTable
{
    public function ajax()
    {
        $properties = $this->query();

        return $this->datatables
            ->of($properties)
            ->addColumn('action', function ($properties) {
                $edit = $delete = '';
                if (Common::has_permission(\Auth::guard('admin')->user()->id, 'edit_properties')) {
                    $edit = '<a href="' . url('admin/listing/' . $properties->properties_id) . '/basics" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                }
                if (Common::has_permission(\Auth::guard('admin')->user()->id, 'delete_property')) {
                    $delete = '<a href="' . url('admin/delete-property/' . $properties->properties_id) . '" class="btn btn-xs     btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
                }
                return $edit . $delete;
            })
            ->addColumn('host_name', function ($properties) {
                return '<a href="' . url('admin/edit-customer/' . $properties->host_id) . '">' . ucfirst($properties->first_name) . '</a>';
            })
            ->addColumn('property_featured', function ($properties) {
                //this addcolmn added newly
                if ($properties->featured==1) {
                    $makeFeatured='<button id="btnFeatured" class="btnFeatured btn btn-xs btn-success" value='.$properties->properties_id. '>'.'Featured</button>';
                } else {
                    $makeFeatured='<button id="btnFeatured" class="btnFeatured btn btn-xs btn-secondary" value=' .$properties->properties_id. '>' . 'None</button>';
                }
                return $makeFeatured;
            })
            ->addColumn('property_name', function ($properties) {
                return '<a href="' . url('admin/listing/' . $properties->properties_id . '/basics') . '">' . ucfirst($properties->property_name) . '</a>';
            })
            ->addColumn('property_created_at', function ($properties) {
                return dateFormat($properties->property_created_at);
            })
            ->make(true);
    }

    public function query()
    {
        $user_id    = Request::segment(4);
        $status     = !empty($_GET['status']) ? $_GET['status'] : null;
        $from       = !empty($_GET['from']) ? setDateForDb($_GET['from']) : null;
        $to         = !empty($_GET['to']) ?  setDateForDb($_GET['to']): null;
        $space_type = !empty($_GET['space_type']) ? $_GET['space_type'] : null;
        $query      = Properties::join('users', function ($join) {
                                $join->on('users.id', '=', 'properties.host_id');
        })
                        ->join('space_type', function ($join) {
                                $join->on('space_type.id', '=', 'properties.space_type');
                        })

                        ->select(['properties.id as properties_id', 'properties.name as property_name', 'properties.status as property_status', 'properties.created_at as property_created_at', 'properties.updated_at as property_updated_at', 'properties.*', 'users.*', 'space_type.*']);

        if (isset($user_id) && is_int($user_id)) {
            $query->where('properties.host_id', '=', $user_id);
        }
        if ($from) {
             $query->whereDate('properties.created_at', '>=', $from);
        }
        if ($to) {
             $query->whereDate('properties.created_at', '<=', $to);
        }
        if ($status) {
            $query->where('properties.status', '=', $status);
        }
        if ($space_type) {
            $query->where('properties.space_type', '=', $space_type);
        }
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'properties_id', 'name' => 'properties.id', 'title' => 'Id'])
            ->addColumn(['data' => 'property_name', 'name' => 'properties.name', 'title' => 'Name'])
            ->addColumn(['data' => 'host_name', 'name' => 'users.first_name', 'title' => 'Host Name'])
            ->addColumn(['data' => 'space_type_name', 'name' => 'space_type.name', 'title' => 'Space Type'])
            ->addColumn(['data' => 'property_status', 'name' => 'properties.status', 'title' => 'Status'])
            ->addColumn(['data' => 'property_created_at', 'name' => 'properties.created_at', 'title' => 'Date'])
            //added newly
            ->addColumn(['data' => 'property_featured', 'name' => 'properties.featured', 'title' => 'Featured'])
            ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
            ->parameters([
                'dom' => 'lBfrtip',
                'buttons' => [],
                'order' => [0, 'desc'],
                'pageLength' => \Session::get('row_per_page'),
            ]);
    }

    protected function getColumns()
    {
        return [
            'id',
            'created_at',
            'updated_at',
        ];
    }

    protected function filename()
    {
        return 'propertydatatables_' . time();
    }
}
