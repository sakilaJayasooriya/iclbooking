<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmailController;
use View;
use App\Models\Bookings;
use App\Models\BookingDetails;
use App\Models\Messages;
use App\Models\Penalty;
use App\Models\Payouts;
use App\Models\Properties;
use App\Models\PayoutPenalties;
use App\Models\PropertyDates;
use App\Models\PropertyFees;
use App\Models\Settings;
use Auth;
use DB;
use Session;
use DateTime;

class BookingController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(Request $request)
    {
        
        $data['booking_id'] = $request->id;

        $read_count   = Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->where('read', 0)->count();

        if ($read_count !=0) {
            Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->update(['read' => '1']);

        }

        $data['result']         = Bookings::find($request->id);

        if (! $data['result']) {
            abort('404');
        }

        if ($data['result']->host_id != Auth::user()->id) {
            abort('404');
        }
        
        $data['title'] = 'Booking Details';
        return view('booking.detail', $data);
   }

    public function requested(Request $request)
    {
        $data['booking_details'] = Bookings::where('code', $request->code)->first();
        return view('booking.requested', $data);
    }

    public function accept(Request $request, EmailController $email)
    {
        $booking = Bookings::find($request->id);
      
        $penalty = Penalty::where('user_id', Auth::user()->id)->where('remaining_penalty', '!=', 0)->get();
        $penalty_result = $this->helper->host_penalty_check($penalty, $booking->host_payout, $booking->currency_code);
      
        $booking->status            = 'Accepted';
        $booking->accepted_at       = date('Y-m-d H:i:s');
        $booking->save();

        $payouts = new Payouts;
        $payouts->booking_id     = $request->id;
        $payouts->property_id    = $booking->property_id;
        $payouts->user_id        = $booking->host_id;
        $payouts->user_type      = 'host';
        $payouts->amount         = $penalty_result['host_amount'];
        $payouts->penalty_amount = $penalty_result['penalty_total'];
        $payouts->currency_code  = $booking->currency_code;
        $payouts->status         = 'Future';
        $payouts->save();

        $panalty_ids = explode(',', $penalty_result['penalty_ids']);
        $panalty_amounts = explode(',', $penalty_result['panalty_amounts']);
      
        for ($i=0; $i < count($panalty_ids); $i++) {
            if ($panalty_ids[$i] != '' && $panalty_amounts[$i] != '') {
                $payout_penalties = new PayoutPenalties;
                $payout_penalties->payout_id  = $payouts->id;
                $payout_penalties->penalty_id = $panalty_ids[$i];
                $payout_penalties->amount     = $panalty_amounts[$i];
                $payout_penalties->save();
            }
        }

        $messages = new Messages;
        $messages->property_id    = $booking->property_id;
        $messages->booking_id     = $booking->id;
        $messages->receiver_id    = $booking->user_id;
        $messages->sender_id      = Auth::user()->id;
        $messages->message        = $request->message;
        $messages->type_id        = 5;
        $messages->save();
        $status = 'Accepted';
        $email->bookingAcceptedOrDeclined($request->id, $status);
        $companyName = Settings::where(['type' => 'general', 'name' => 'name'])->first(['value'])->value;
        $requestBookingConfirm = ($companyName.': ' .'Your booking request for'.' '.$booking->properties->name .' '.'is Accepted.');
        
          
       twilioSendSms($booking->users->formatted_phone, $requestBookingConfirm);
      
        $this->helper->one_time_message('success', trans('messages.success.booking_accept_success'));
        return redirect('booking/'.$request->id);
    }

    public function decline(Request $request, EmailController $email)
    {

        $booking                  = Bookings::find($request->id);
        $booking->status          = 'Declined';
        $booking->declined_at     = date('Y-m-d H:i:s');
        $booking->save();

        $booking_details             = new BookingDetails;
        $booking_details->booking_id = $request->id;
        $booking_details->field      = 'decline_reason';
        $booking_details->value      = ($request->decline_reason == 'other') ? $request->decline_reason_other : $request->decline_reason;
        $booking_details->save();

        $payouts                 = new Payouts;
        $payouts->booking_id     = $request->id;
        $payouts->property_id    = $booking->property_id;
        $payouts->user_id        = $booking->user_id;
        $payouts->user_type      = 'guest';
        $payouts->amount         = $booking->original_guest_payout;
        $payouts->penalty_amount = 0;
        $payouts->currency_code  = $booking->currency_code;
        $payouts->status         = 'Future';
        $payouts->save();

        if ($request->block_calendar == 'yes') {
            $days = $this->helper->get_days($booking->start_date, $booking->end_date);
        
            for ($i=0; $i<count($days)-1; $i++) {
                $property_date = [
                                'property_id' => $booking->property_id,
                                'date'        => $days[$i],
                                'status'      => 'Not available'
                                ];

                PropertyDates::updateOrCreate(['property_id' => $booking->property_id, 'date' => $days[$i]], $property_date);
            }
        } else {
            $days = $this->helper->get_days($booking->start_date, $booking->end_date);
        
            for ($i=0; $i<count($days)-1; $i++) {
                $property_date = [
                                'property_id' => $booking->property_id,
                                'date'        => $days[$i],
                                'status'  => 'Available'
                                ];

                PropertyDates::updateOrCreate(['property_id' => $booking->property_id, 'date' => $days[$i]], $property_date);
            }
        }

        $messages = new Messages;

        $messages->property_id    = $booking->property_id;
        $messages->booking_id     = $booking->id;
        $messages->receiver_id    = $booking->user_id;
        $messages->sender_id      = Auth::user()->id;
        $messages->message        = $request->message;
        $messages->type_id        = 6;

        $messages->save();
        $status = 'Declined';
        $email->bookingAcceptedOrDeclined($request->id, $status);
        $companyName = Settings::where(['type' => 'general', 'name' => 'name'])->first(['value'])->value;
        $requestBookingDecline = ($companyName.': ' .'Your booking request for'.' '.$booking->properties->name .' '.'is Declined.');
       twilioSendSms($booking->users->formatted_phone, $requestBookingDecline);
        
        $this->helper->one_time_message('success', trans('messages.success.booking_decline_success'));
        return redirect('booking/'.$request->id);
    }

    public function expire(Request $request)
    {

        $booking = Bookings::find($request->id);
      
        $fees = PropertyFees::pluck('value', 'field');

        $host_penalty     = $fees['host_penalty'];
        $currency         = $fees['currency'];
        $more_then_seven  = $fees['more_then_seven'];
        $less_then_seven  = $fees['less_then_seven'];
        $cancel_limit     = $fees['cancel_limit'];
          
        if (Session::get('currency')) {
            $code =  Session::get('currency');
        } else {
            $code = DB::table('currency')->where('default', 1)->first()->code;
        }

        if ($host_penalty != 0) {
            $penalty                  = new Penalty;
            $penalty->property_id     = $booking->property_id;
            $penalty->user_id         = $booking->user_id;
            $penalty->booking_id      = $request->id;
            $penalty->currency_code   = $booking->currency_code;
            $penalty->amount          = $this->helper->convert_currency($penalty_currency, $code, $penalty_before_days);
            $penalty->remain_amount   = $penalty->amount;
            $penalty->status          = "Pending";
            $penalty->save();
        }
      
        $to_time   = strtotime($booking->created_at);
        $from_time = strtotime(date('Y-m-d H:i:s'));
        $diff_mins = round(abs($to_time - $from_time) / 60, 2);

        if ($diff_mins >= 1440) {
            $booking->status       = 'Expired';
            $booking->expired_at   = date('Y-m-d H:i:s');
            $booking->save();

            $days = $this->helper->get_days($booking->start_date, $booking->end_date);
            for ($j=0; $j<count($days)-1; $j++) {
                PropertyDates::where('property_id', $booking->property_id)->where('date', $days[$j])->where('status', 'Not available')->delete();
            }

            $payouts = new Payouts;
            $payouts->booking_id     = $request->id;
            $payouts->property_id    = $booking->property_id;
            $payouts->user_id        = $booking->user_id;
            $payouts->user_type      = 'guest';
            $payouts->amount         = $booking->original_guest_payout;
            $payouts->penalty_amount = 0;
            $payouts->currency_code  = $booking->currency_code;
            $payouts->status         = 'Future';
            $payouts->save();

            $messages = new Messages;
            $messages->property_id    = $booking->property_id;
            $messages->booking_id     = $booking->id;
            $messages->receiver_id    = $booking->user_id;
            $messages->sender_id      = Auth::user()->id;
            $messages->message        = '';
            $messages->type_id        = 7;
            $messages->save();

            $this->helper->one_time_message('success', trans('messages.success.booking_expire_success'));
            return redirect('booking/'.$request->id);
        } else {
            $this->helper->one_time_message('error', trans('messages.error.booking_expire_error'));
            return redirect('booking/'.$request->id);
        }
    }

    public function myBookings(Request $request)
    {
      
        if ($request->all == 1) {
            $data['code']     = '1';
            $data['bookings'] = Bookings::where('host_id', Auth::user()->id)->get();
            // $data['bookings'] = Bookings::where('user_id', Auth::user()->id)->get();
        } else {
          
            $data['code']     = '0';
            $data['bookings'] = Bookings::where('host_id', Auth::user()->id)->where('end_date','>=',date('Y-m-d'))->get();
            // $data['bookings'] = Bookings::where('user_id', Auth::user()->id)->where('end_date', '>=', date('Y-m-d'))->get();
        }

        $data['print'] = $request->print;
        return view('booking.my_bookings', $data);
    }

    public function hostCancel(Request $request, EmailController $email)
    {  
        $bookings    = Bookings::find($request->id);
        $now         = new DateTime();
        $booking_end = new DateTime($bookings->end_date);

        if ($now < $booking_end) {
          
            $properties = Properties::find($bookings->property_id);
            $payount    = Payouts::where(['user_id'=>$bookings->host_id,'booking_id'=> $request->id])->first();
        
            if (isset($payount->id)) {
                $payout_penalties = PayoutPenalties::where('payout_id', $payount->id)->get();
                if (!empty($payout_penalties)) {
                    foreach ($payout_penalties as $key => $payout_penalty) {
                        $prv_penalty = Penalty::where('id', $payout_penalty->penalty_id)->first();
                        $update_amount = $prv_penalty->remaining_penalty+$payout_penalty->amount;
                        Penalty::where('id', $payout_penalty->penalty_id)->update(['remaining_penalty' => $update_amount, 'status' => 'Pending']);
                    }
                }
            }

            $payouts = new Payouts;
            $payouts->booking_id     = $request->id;
            $payouts->property_id    = $bookings->property_id;
            $payouts->user_id        = $bookings->user_id;
            $payouts->user_type      = 'guest';
            $payouts->amount         = $bookings->original_total;
            $payouts->currency_code  = $bookings->currency_code;
            $payouts->penalty_amount = 0;
            $payouts->status         = 'Future';
            $payouts->save();

        

            if ($bookings->booking_type != 'instant' || $request->cancel_reason != 'i_am_uncomfortable_with_guest') {
                $start_date = new DateTime($bookings->start_date);
                $panalty_date = new DateTime(date('Y-m-d H:i:s', strtotime('-7 days')));
                $fees = PropertyFees::pluck('value', 'field')->toArray();
                if ($start_date >= $panalty_date) {
                  //more then 7 days
                    $panalty = new Penalty;
                    $panalty->booking_id        = $request->id;
                    $panalty->property_id       = $bookings->property_id;
                    $panalty->user_id           = Auth::user()->id;
                    $panalty->user_type         = 'Host';
                    $panalty->currency_code     = $bookings->currency_code;
                    $panalty->amount            = $fees['more_then_seven'];
                    $panalty->remaining_penalty = $fees['more_then_seven'];
                    $panalty->reason            = 'cancelation';
                    $panalty->save();
                } else {
                  //less then 7 days
                    $panalty = new Penalty;
                    $panalty->booking_id        = $request->id;
                    $panalty->property_id       = $bookings->property_id;
                    $panalty->user_id           = Auth::user()->id;
                    $panalty->user_type         = 'Host';
                    $panalty->currency_code     = $bookings->currency_code;
                    $panalty->amount            = $fees['less_then_seven'];
                    $panalty->remaining_penalty = $fees['less_then_seven'];
                    $panalty->reason            = 'cancelation';
                    $panalty->save();
                }
            } else {
                $days = $this->helper->get_days($bookings->start_date, $bookings->end_date);

                for ($j=0; $j<count($days)-1; $j++) {
                    PropertyDates::where('property_id', $bookings->property_id)->where('date', $days[$j])->where('status', 'Not available')->delete();
                }
            }
        
            Payouts::where(['user_id'=>$bookings->host_id,'booking_id'=> $request->id])->delete();

            $messages                 = new Messages;
            $messages->property_id    = $bookings->property_id;
            $messages->booking_id     = $bookings->id;
            $messages->receiver_id    = $bookings->user_id;
            $messages->sender_id      = Auth::user()->id;
            $messages->message        = $request->cancel_message;
            $messages->type_id        = 3;
            $messages->save();

            $cancel = Bookings::find($request->id);
            $cancel->cancelled_by = "Host";
            $cancel->cancelled_at = date('Y-m-d H:i:s');
            $cancel->status = "Cancelled";
            $cancel->save();

            $booking_details = new BookingDetails;
            $booking_details->booking_id = $request->id;
            $booking_details->field      = 'cancelled_reason';
            $booking_details->value      = $request->cancel_reason;
            $booking_details->save();
            $email->bookingCancellation($request->id);
            $this->helper->one_time_message('success', trans('messages.success.resere_cancel_success'));
            return redirect('my-bookings');
        } else {
            $this->helper->one_time_message('danger', trans('messages.error.you_cant_cancel_booking_now'));
            return redirect('my-bookings');
        }
    }
}
