<?php

/**
 * Reviews Controller
 *
 * Reviews Controller manages Reviews by admin.
 *
 * @category   Reviews
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

use App\DataTables\ReviewsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\Properties;
use App\Models\Reviews;
use App\Models\Settings;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;

class ReviewsController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(ReviewsDataTable $dataTable)
    {
        $data['from'] = isset($_GET['from']) ? $_GET['from'] : null;
        $data['to']   = isset($_GET['to']) ? $_GET['to'] : null;
        $data['property'] = Properties::get();

        if (isset($_GET['property'])) {
            $data['properties'] = $properties = Properties::where('properties.id', $_GET['property'])->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }
        if (isset($_GET['reset_btn'])) {
            $data['from']          = null;
            $data['to']            = null;
            $data['allreviewer']   = '';
            $data['allproperties'] = '';
            return $dataTable->render('admin.reviews.view', $data);
        }
        isset($_GET['property']) ? $data['allproperties'] = $allproperties = $_GET['property'] : $data['allproperties'] = $allproperties = '';
        isset($_GET['reviewer']) ? $data['allreviewer'] = $allreviewer = $_GET['reviewer'] : $data['allreviewer'] = $allreviewer = '';
        return $dataTable->render('admin.reviews.view', $data);
    }

    public function edit(Request $request)
    {
        
        if (!$_POST) {
            $data['result'] = Reviews::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'reviews.property_id');
            })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'reviews.sender_id');
                        })
                        ->join('users as receiver', function ($join) {
                                $join->on('receiver.id', '=', 'reviews.receiver_id');
                        })
                        ->where('reviews.id', $request->id)->select(['reviews.id as id', 'booking_id', 'properties.name as property_name', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer','rating','accuracy','location','communication','checkin','cleanliness','value','message'])->first();
            return view('admin.reviews.edit', $data);
        } elseif ($request->submit) {
           
            $rules = array(
                    'message' => 'required'
                    );

            $niceNames = array(
                        'message' => 'Message'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($niceNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else {
                $user                  = Reviews::find($request->id);
                $user->message         = $request->message;
                $user->rating          = $request->rating;
                $user->accuracy        = $request->accuracy;
                $user->location        = $request->accuracy;
                $user->communication   = $request->communication;
                $user->checkin         = $request->checkin;
                $user->cleanliness     = $request->cleanliness;
                $user->value           = $request->value;
                 
                $user->save();
                $this->helper->one_time_message('success', 'Updated Successfully'); 
                return redirect('admin/reviews');
            }
        } else {
            return redirect('admin/reviews');
        }
    }
    
  
    public function searchReview(Request $request)
    {

        $str = $request->term;
        if ($str == null) {
           
            $myresult = Reviews::with(['properties' => function ($query) {
                $query->select('id', 'name as text');
            }])->distinct()->get(['property_id']);
        } else {
            $myresult = Reviews::with(['properties' => function ($query) use ($str) {
                $query->where('name', 'LIKE', '%'.$str.'%')
                      ->select('id', 'name as text');
            }])->get();
        }
        $arr2 = array(
            "id" => "",
            "text" => "All"
            );
      
        $myArr[] = ($arr2);
        foreach ($myresult as $result) {
            if ($result->properties!=null) {
                $arr = array(
                "id" => $result->properties->id,
                "text" => $result->properties->text
                );
                $myArr[] = ($arr);
            }
        }
        
        return $myArr;
    }

    public function reviewCsv()
    {
        $to                 = $_GET['to'];
        $from               = $_GET['from'];
        $reviewer = isset($_GET['reviewer']) ? $_GET['reviewer'] : 'null';
        $property = isset($_GET['property']) ? $_GET['property'] : 'null';
        $reviews           = $this->getAllReviews();
        if ($from) {
            $reviews->whereDate('reviews.created_at', '>=', $from);
        }
        if ($to) {
            $reviews->whereDate('reviews.created_at', '<=', $to);
        }
        if ($property) {
            $reviews->where('properties.id', '=', $property);
        }
        if ($reviewer) {
            $reviews->where('reviews.reviewer', '=', $reviewer);
        }
        $reviewList = $reviews->get();
        if ($reviewList->count()) {
            foreach ($reviewList as $key => $value) {
                    $data[$key]['Property Name'] = $value->property_name;
                    $data[$key]['Sender']        = $value->sender;
                    $data[$key]['Receiver']      = $value->receiver;
                    $data[$key]['Reviewer']      = $value->reviewer;
                    $data[$key]['Message']       = $value->message;
                    $data[$key]['Date']          = dateFormat($value->created_at);
            }
        } else {
            $data = null;
        }
            return Excel::create('review_sheet' . time() . '', function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xls');
    }

    public function reviewPdf()
    {
        $to                 = $_GET['to'];
        $from               = $_GET['from'];
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
        if ($logo->value == null) {
            $data['logo_flag'] = 0;
        } elseif (!file_exists("public/front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }
        $data['reviewer']     = $reviewer = isset($_GET['reviewer']) ? $_GET['reviewer'] : 'null';
        $data['property']     = $property = isset($_GET['property']) ? $_GET['property'] : 'null';
        $reviews              = $this->getAllReviews();
        if ($from) {
            $reviews->whereDate('reviews.created_at', '>=', $from);
        }
        if ($to) {
            $reviews->whereDate('reviews.created_at', '<=', $to);
        }
        if ($property) {
            $reviews->where('properties.id', '=', $property);
        }
        if ($reviewer) {
            $reviews->where('reviews.reviewer', '=', $reviewer);
        }
        if ($from && $to) {
            $data['date_range'] = $from . ' To ' . $to;
        }
        
        $data['reviewList'] = $reviews->get();
        $pdf = PDF::loadView('admin.reviews.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('review_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function getAllReviews()
    {
        $reviews = Reviews::join('properties', function ($join) {
            $join->on('properties.id', '=', 'reviews.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'reviews.sender_id');
        })
        ->join('users as receiver', function ($join) {
                $join->on('receiver.id', '=', 'reviews.receiver_id');
        })
        ->select(['reviews.id as id', 'booking_id', 'properties.name as property_name', 'properties.id as property_id', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer', 'message', 'reviews.created_at as created_at', 'reviews.updated_at as updated_at'])
        ->orderBy('reviews.id', 'desc');
        return $reviews;
    }
}
