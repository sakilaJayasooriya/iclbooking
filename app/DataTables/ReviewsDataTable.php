<?php

namespace App\DataTables;

use App\Models\Reviews;
use Yajra\Datatables\Services\DataTable;

class ReviewsDataTable extends DataTable
{
    
    public function ajax()
    {
        $reviews = $this->query();

        return $this->datatables
            ->of($reviews)
            ->addColumn('action', function ($reviews) {

                $edit = '<a href="' . url('admin/edit_review/' . $reviews->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;';
                return $edit;
            })
            ->addColumn('property_name', function ($reviews) {
                return '<a href="' . url('admin/edit_review/' . $reviews->id) . '">' . $reviews->property_name . '</a>';
            })
            ->addColumn('sender', function ($reviews) {
                return '<a href="' . url('admin/edit_customer/' . $reviews->sender_id) . '">' . $reviews->sender . '</a>';
            })
            ->addColumn('receiver', function ($reviews) {
                return '<a href="' . url('admin/edit_customer/' . $reviews->receiver_id) . '">' . $reviews->receiver . '</a>';
            })
            ->addColumn('created_at', function ($reviews) {
                return dateFormat($reviews->created_at);
            })
            ->make(true);
    }

    
    public function query()
    {
        $from      = isset($_GET['from']) ? setDateForDb($_GET['from']) : null;
        $to        = isset($_GET['to']) ? setDateForDb($_GET['to']) : null;
        $property  = isset($_GET['property']) ? $_GET['property'] : null;
        $reviewer  = isset($_GET['reviewer']) ? $_GET['reviewer'] : null;
        $reviews   = Reviews::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'reviews.property_id');
        })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'reviews.sender_id');
                        })
                        ->join('users as receiver', function ($join) {
                                $join->on('receiver.id', '=', 'reviews.receiver_id');
                        })
                        ->select(['reviews.id as id', 'sender_id', 'receiver_id', 'booking_id', 'properties.name as property_name', 'properties.id as property_id', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer', 'message', 'reviews.created_at as created_at', 'reviews.updated_at as updated_at']);
        if (!empty($from)) {
             $reviews->whereDate('reviews.created_at', '>=', $from);
        }
        if (!empty($to)) {
             $reviews->whereDate('reviews.created_at', '<=', $to);
        }
        if (!empty($property)) {
            $reviews->where('properties.id', '=', $property);
        }
        if (!empty($reviewer)) {
            $reviews->where('reviews.reviewer', '=', $reviewer);
        }
        return $this->applyScopes($reviews);
    }
   
    public function html()
    {
        return $this->builder()
        ->addColumn(['data' => 'id', 'name' => 'reviews.id', 'title' => 'Id', 'visible' => false, 'searchable' => false])

        ->addColumn(['data' => 'property_name', 'name' => 'properties.name', 'title' => 'Property Name'])
        ->addColumn(['data' => 'sender', 'name' => 'users.first_name', 'title' => 'Sender'])
        ->addColumn(['data' => 'receiver', 'name' => 'receiver.first_name', 'title' => 'Receiver'])
        ->addColumn(['data' => 'reviewer', 'name' => 'reviews.reviewer', 'title' => 'Reviewer'])
        ->addColumn(['data' => 'message', 'name' => 'message', 'title' => 'Message'])
        ->addColumn(['data' => 'created_at', 'name' => 'reviews.created_at', 'title' => 'Date'])
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
        return 'reviewdatatables_' . time();
    }
}
