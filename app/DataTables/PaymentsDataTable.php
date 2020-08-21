<?php

namespace App\DataTables;

use App\Models\Payment;
use App\Models\Photo;
use App\Models\User;
use Yajra\Datatables\Services\DataTable;

class PaymentsDataTable extends DataTable
{
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
             ->addColumn('title', function ($payments) {
                $title = $payments->photos->title;
                return $title;
             })
            ->addColumn('image', function ($payments) {
                $image = '<a href="' . url('admin/display_photo/' . $payments->photo_id) . '" >' . '<img src="' . url('/public/images/uploads/' . $payments->user_id . '/' . 'small/' . $payments->photos->image) . '" width="50" height="50">' . '</a>';
                return $image;
            })
              ->addColumn('payment_method', function ($payments) {
                $payment_method = $payments->method->name;
                return $payment_method;
              })
            ->make(true);
    }

    public function query()
    {
        $query = Payment::join('photos', 'payments.photo_id', '=', 'photos.id')->select(['payments.*', 'photos.*']);
        return $this->applyScopes($query);
    }

    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'payments.id', 'title' => 'Id'])
            ->addColumn(['data' => 'image', 'name' => 'image', 'title' => 'Image','orderable' => false, 'searchable' => false])
            ->addColumn(['data' => 'title', 'name' => 'photos.title', 'title' => 'Image Title','orderable' => false])
            ->addColumn(['data' => 'amount', 'name' => 'payments.amount', 'title' => 'Amount'])
            ->addColumn(['data' => 'currncy_code', 'name' => 'payments.currncy_code', 'title' => 'Currency Code'])
            ->addColumn(['data' => 'status', 'name' => 'payments.status', 'title' => 'Status'])
            ->addColumn(['data' => 'payment_method', 'name' => 'payments.payment_method', 'title' => 'Payment Method'])
            ->addColumn(['data' => 'created_at', 'name' => 'payments.created_at', 'title' => 'Created At'])
            ->addColumn(['data' => 'updated_at', 'name' => 'payments.updated_at', 'title' => 'Updated At'])
            ->parameters($this->getBuilderParameters());
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
        return 'membersdatatables_' . time();
    }
}
