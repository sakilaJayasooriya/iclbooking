<?php

namespace App\DataTables;

use Yajra\Datatables\Services\DataTable;
use App\Models\Payouts;
use Request;

class PayoutsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        $payouts = $this->query();

        return $this->datatables
            ->of($payouts)
            ->addColumn('user', function ($payouts) {
                return '<a href="' . url('admin/edit-customer/' . $payouts->user_id) . '">' . ucfirst($payouts->user) . '</a>';
            })
            ->addColumn('property_name', function ($payouts) {
                return '<a href="' . url('admin/listing/' . $payouts->property_id) . '/basics' . '">'. ucfirst($payouts->property_name) . '</a>';
            })
            ->addColumn('payouts_date', function ($payouts) {
                return dateFormat($payouts->payouts_date);
            })
            ->addColumn('payouts_amount', function ($payouts) {
              return  moneyFormat($payouts->currency->symbol, $payouts->amount);
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
          $user_id = Request::segment(4);
        
        $status   = isset($_GET['status']) ? $_GET['status'] : null;
        $from     = isset($_GET['from']) ? setDateForDb($_GET['from']) : null;
        $to       = isset($_GET['to']) ? setDateForDb($_GET['to']) : null;
        $types    = isset($_GET['types']) ? $_GET['types'] : null;
        $property = isset($_GET['property']) ? $_GET['property'] : null;

        $payouts  = Payouts::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'payouts.property_id');
        })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'payouts.user_id');
                        })
                        ->join('currency', function ($join) {
                                $join->on('currency.code', '=', 'payouts.currency_code');
                        })
                        ->select(['properties.name as property_name', 'users.first_name AS user', \DB::raw('CONCAT(currency.symbol, payouts.amount) AS payouts_amount'), \DB::raw('CONCAT(currency.symbol, payouts.penalty_amount) AS penalty'), 'payouts.account as payouts_account', 'payouts.updated_at as payouts_date', 'payouts.*']);

        if (isset($user_id) && is_int($user_id)) {
             $payouts->where('payouts.user_id', '=', $user_id);
        }
        if (!empty($from)) {
             $payouts->whereDate('payouts.created_at', '>=', $from);
        }
        if (!empty($to)) {
             $payouts->whereDate('payouts.created_at', '<=', $to);
        }
        if (!empty($property)) {
            $payouts->where('payouts.property_id', '=', $property);
        }
        if (!empty($status)) {
            $payouts->where('payouts.status', '=', $status);
        }
        if (!empty($types)) {
            $payouts->where('payouts.user_type', '=', $types);
        }


        return $this->applyScopes($payouts);
    }
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->addColumn(['data' => 'id', 'name' => 'payouts.id', 'title' => 'ID', 'visible' => false])
            ->addColumn(['data' => 'user', 'name' => 'users.first_name', 'title' => 'User'])
            ->addColumn(['data' => 'user_type', 'name' => 'payouts.user_type', 'title' => 'User Type'])
            ->addColumn(['data' => 'property_name', 'name' => 'properties.name', 'title' => 'Property Name'])
            ->addColumn(['data' => 'payouts_account', 'name' => 'payouts.account', 'title' => 'Payouts Account'])
            ->addColumn(['data' => 'payouts_amount', 'name' => 'payouts.amount', 'title' => 'Amount'])
            //When need the panalty column just uncomment this line
            // ->addColumn(['data' => 'penalty', 'name' => 'payouts.penalty_amount', 'title' => 'Penalty'])
            ->addColumn(['data' => 'status', 'name' => 'payouts.status', 'title' => 'Status'])
            ->addColumn(['data' => 'payouts_date', 'name' => 'payouts.updated_at', 'title' => 'Date'])
            ->parameters([
                'order' => [0, 'desc'], 'pageLength' => \Session::get('row_per_page'),
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
            // add your columns
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
        return 'payoutsdatatables_' . time();
    }
}
