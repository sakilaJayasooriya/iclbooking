<?php

namespace App\DataTables;

use App\Models\ListingMsg;
use App\Models\User;
use App\Models\Properties;
use Yajra\Datatables\Services\DataTable;

class ListingMsgDataTable extends DataTable
{
    protected $exportColumns = ['id', 'msg'];
    public function ajax()
    {
        $listing_msg = $this->query();
        return $this->datatables
            ->of($listing_msg)
            ->addColumn('sender', function ($listing_msg) {
                return '<a href="'. url('admin/edit-customer/' . $listing_msg->sender_id) . '" >'.$listing_msg->uSenderFname.'</a>';
            })
            ->addColumn('receiver', function ($listing_msg) {
                return '<a href="'. url('admin/edit-customer/' . $listing_msg->receiver_id) . '" >'.$listing_msg->uReceiverFname.'</a>';
            })
            ->addColumn('property', function ($listing_msg) {
                return '<a href="'. url('admin/listing/' . $listing_msg->prpertyId.'/basics') . '" >View</a>';
            })
            ->addColumn('msg', function ($listing_msg) {
                return ' '.$listing_msg->msg;
            })
            ->addColumn('action', function ($listing_msg) {
                return '<a href="' . url('admin/listing-message/' . $listing_msg->id) . '" class="btn btn-xs btn-danger delete-warning"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->make(true);


    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {

        $query = ListingMsg::join('users as uSender', 'listing_msg.sender_id', '=', 'uSender.id')
        ->join('properties as listningp', 'listing_msg.property_id', '=', 'listningp.id')
        ->join('users as uReceiver', 'listing_msg.receiver_id', '=', 'uReceiver.id')
        ->select([
            'listing_msg.id',
            'listing_msg.msg',
            'listing_msg.sender_id',
            'listing_msg.receiver_id',
            'listing_msg.property_id',
            'uSender.id as uSenderId',
            'uSender.first_name as uSenderFname',
            'uReceiver.id as uReceiverId',
            'uReceiver.first_name as uReceiverFname',
            'listningp.id as prpertyId',
            ]);
        return $this->applyScopes($query);

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
                        'id',
                    ])
                    ->addColumn(['data' => 'sender', 'name' => 'sender', 'title' => 'Sender'])
                    ->addColumn(['data' => 'receiver', 'name' => 'receiver', 'title' => 'Receiver'])
                    ->addColumn(['data' => 'property', 'property' => 'property', 'title' => 'Property'])
                    ->addColumn(['data' => 'msg', 'name' => 'Message', 'title' => 'Message'])
                    ->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false])
                    ->parameters([
                        'dom' => 'lBfrtip',
                        'buttons' => [],
                        'order' => [0, 'asc'],
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
        return 'listingmsgdatatables_' . time();
    }
}
