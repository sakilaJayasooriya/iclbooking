<?php

/**
 * Payouts Controller
 *
 * Payouts Controller manages Payouts by admin.
 *
 * @category   Payouts
 * @package    vRent
 * @author     Techvillage Dev Team
 * @copyright  2020 Techvillage
 * @license
 * @version    2.7
 * @link       http://techvill.net
 * @email      support@techvill.net
 * @since      Version 1.3
 * @deprecated None
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PayoutsDataTable;
use App\Models\Payouts;
use App\Models\Settings;
use App\Models\Properties;
use App\Models\Currency;
use PDF;
use Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\Common;
use DB;

class PayoutsController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(PayoutsDataTable $dataTable)
    {

        $data['from'] = isset($_GET['from']) ? $_GET['from'] : null;
        $data['to']   = isset($_GET['to']) ? $_GET['to'] : null;
        if (isset($_GET['property'])) {
            $data['properties'] = Properties::where('properties.id', $_GET['property'])->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }

        if (isset($_GET['btn'])) {
            $status     = $_GET['status'];
            $types      = $_GET['types'];
            $from       = $_GET['from'];
            $to         = $_GET['to'];
            if (isset($_GET['property'])) {
                $property    = $_GET['property'];
            } else {
                $property    = null;
            }
        } else {
            $status     = null;
            $types      = null;
            $property   = null;
            $from       = null;
            $to         = null;
        }

        $total_payouts_initial = $this->getAllPayouts();
        $total_payouts         = $this->getAllPayouts();
        $data['total_payouts'] = $total_payouts->get()->count();

        $different_currency_total_initial  = $total_payouts_initial->select('payouts.currency_code as currency_code', DB::raw('SUM(payouts.amount) AS total_amount'))->groupBy('currency_code');
        $different_currency_total          = $different_currency_total_initial->get();
        $data['different_total_amounts']   = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total);

        if (isset($_GET['reset_btn'])) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['alltypes']   = '';
            $data['allproperties']   = '';
            return $dataTable->render('admin.payouts.view', $data);
        }

        if ($from) {
            $total_payouts = $total_payouts->whereDate('payouts.created_at', '>=', $from);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('payouts.created_at', '>=', $from);
        }
        if ($to) {
            $total_payouts = $total_payouts->whereDate('payouts.created_at', '<=', $to);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('payouts.created_at', '<=', $to);
        }
        if ($property) {
            $total_payouts = $total_payouts->where('payouts.property_id', '=', $property);
            $different_currency_total_initial = $different_currency_total_initial->where('payouts.property_id', '=', $property);
        }
        if ($status) {
            $total_payouts = $total_payouts->where('payouts.status', '=', $status);
            $different_currency_total_initial = $different_currency_total_initial->where('payouts.status', '=', $status);
        }
        if ($types) {
            $total_payouts = $total_payouts->where('payouts.user_type', '=', $types);
            $different_currency_total_initial = $different_currency_total_initial->where('payouts.user_type', '=', $types);
        }

        $data['total_payouts']            = $total_payouts->get()->count();
        $different_currency_total_initial = $different_currency_total_initial->get();

        if (count($different_currency_total_initial)) {
            $data['different_total_amounts'] = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total_initial);
        } else {
            $data['different_total_amounts'] = null;
        }


        isset($_GET['property']) ? $data['allproperties'] = $_GET['property'] : $data['allproperties'] = '';
        isset($_GET['status']) ? $data['allstatus'] = $_GET['status'] : $data['allstatus'] = '';
        isset($_GET['types']) ? $data['alltypes']   = $_GET['types'] : $data['alltypes'] = '';

        return $dataTable->render('admin.payouts.view', $data);
    }

    public function getDistinctCurrencyTotalWithSymbol($different_currency_total)
    {
        $different_total_amounts = null;
        foreach ($different_currency_total as $key => $value) {
            $current_currency_symbol = Currency::where('code', $value->currency_code)->select('symbol AS currency_symbol')->first();
            $different_total_amounts[$key]['total'] = moneyFormat($current_currency_symbol->currency_symbol, $value->total_amount);
            $different_total_amounts[$key]['currency_code'] = $value->currency_code;
        }
        return $different_total_amounts;
    }

    public function payoutsPdf($id = null)
    {
        $to                 = setDateForDb($_GET['to']);
        $from               = setDateForDb($_GET['from']);
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
        if ($logo->value == null) {
            $data['logo_flag'] = 0;
        } elseif (!file_exists("public/front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }

        $data['status']     = $status = isset($_GET['status']) ? $_GET['status'] : 'null';
        $data['types']      = $types  = isset($_GET['types']) ? $_GET['types'] : 'null';
        $data['property']   = $property = isset($_GET['property']) ? $_GET['property'] : 'null';

        $payouts           = $this->getAllPayouts();

        if (isset($id)) {
            $payouts->where('payouts.user_id', '=', $id);
        }
        if ($from) {
            $payouts->whereDate('payouts.created_at', '>=', $from);
        }

        if ($to) {
            $payouts->whereDate('payouts.created_at', '<=', $to);
        }
                                        
        if ($property) {
            $payouts->where('payouts.property_id', '=', $property);
        }

        if ($status) {
            $payouts->where('payouts.status', '=', $status);
        }

        if ($types) {
            $payouts->where('payouts.user_type', '=', $types);
        }
        
        if ($from && $to) {
            $data['date_range'] = onlyFormat($from) . ' To ' . onlyFormat($to);
        }
        
        $data['payoutsList'] = $payouts->get();
        $pdf = PDF::loadView('admin.payouts.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('payouts_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function payoutsCsv($id = null)
    {
        $to                 = setDateForDb($_GET['to']);
        $from               = setDateForDb($_GET['from']);
        $status             = isset($_GET['status']) ? $_GET['status'] : 'null';
        $types              = isset($_GET['types']) ? $_GET['types'] : 'null';
        $property           = isset($_GET['property']) ? $_GET['property'] : 'null';

        $payouts            = $this->getAllPayoutsCSV();
        if (isset($id)) {
            $payouts->where('payouts.user_id', '=', $id);
        }
        if ($from) {
            $payouts->whereDate('payouts.created_at', '>=', $from);
        }

        if ($to) {
            $payouts->whereDate('payouts.created_at', '<=', $to);
        }

        if ($property) {
            $payouts->where('payouts.property_id', '=', $property);
        }

        if ($status) {
            $payouts->where('payouts.status', '=', $status);
        }

        if ($types) {
            $payouts->where('payouts.user_type', '=', $types);
        }

        $payoutsList = $payouts->get();
        
        if ($payoutsList->count()) {
            foreach ($payoutsList as $key => $value) {
                $data[$key]['User']            = $value->user;
                $data[$key]['User Type']       = $value->user_type;
                $data[$key]['Property Name']   = $value->property_name;
                $data[$key]['Payouts Account'] = $value->payouts_account;
                $data[$key]['Currency']        = $value->currency_code;
                $data[$key]['Amount']          = $value->payouts_amount;
                $data[$key]['Status']          = $value->status;
                $data[$key]['Date']            = dateFormat($value->created_at);
            }
        } else {
            $data = null;
        }
        
            return Excel::create('payouts_sheet' . time() . '', function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
    }

    public function getAllPayouts()
    {
        $allPayouts = Payouts::join('properties', function ($join) {
            $join->on('properties.id', '=', 'payouts.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'payouts.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'payouts.currency_code');
        })
        ->select(['properties.name as property_name', 'users.first_name AS user', \DB::raw('CONCAT(currency.symbol, payouts.amount) AS payouts_amount'), \DB::raw('CONCAT(currency.symbol, payouts.penalty_amount) AS penalty'), 'payouts.account as payouts_account', 'payouts.created_at as payouts_date', 'payouts.*'])
        ->orderBy('payouts.id', 'desc');

        return $allPayouts;
    }

    public function getAllPayoutsCSV()
    {
        $allPayouts = Payouts::join('properties', function ($join) {
            $join->on('properties.id', '=', 'payouts.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'payouts.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'payouts.currency_code');
        })
        ->select(['properties.name as property_name', 'users.first_name AS user', \DB::raw('payouts.amount AS payouts_amount'), \DB::raw('payouts.penalty_amount AS penalty'), 'payouts.account as payouts_account', 'payouts.created_at as payouts_date', 'payouts.*'])
        ->orderBy('payouts.id', 'desc');

        return $allPayouts;
    }
}
