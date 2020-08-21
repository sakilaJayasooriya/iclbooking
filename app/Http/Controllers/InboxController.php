<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Messages;
use App\Models\Properties;
use App\Models\Bookings;
use Auth;
use DB;
use validator;

class InboxController extends Controller
{
    private $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index()
    {
        $data['user_id']     = Auth::user()->id;
        $data['all_message'] = Messages::where('receiver_id', $data['user_id'])->orderBy('id', 'desc')->get();

        return view('users.inbox', $data);
    }

    public function messageCount(Request $request)
    {
        $res['user_id'] = $user_id = Auth::user()->id;

        $all    =   Messages::where('receiver_id', $res['user_id'])->count();

        $unread =   Messages::where('receiver_id', $user_id)->where('read', 0)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->with('property_address')->orderBy('id', 'desc')->count();
        $pending =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->whereHas('bookings', function ($query) {
            $query->where('status', 'Pending');
        })->with('property_address')->orderBy('id', 'desc')->count();

        $accepted =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->whereHas('bookings', function ($query) {
            $query->where('status', 'Accepted');
        })->with('property_address')->orderBy('id', 'desc')->count();

        $cancelled =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->whereHas('bookings', function ($query) {
            $query->where('status', 'Cancelled');
        })->with('property_address')->orderBy('id', 'desc')->count();

        $declined =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->whereHas('bookings', function ($query) {
            $query->where('status', 'Declined');
        })->with('property_address')->orderBy('id', 'desc')->count();

        $expired =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
        }])->whereHas('bookings', function ($query) {
            $query->where('status', 'Expired');
        })->with('property_address')->orderBy('id', 'desc')->count();
        if ($all != 0) {
            $res['all_message_count'] = $all;
            $res['unread_count']      = $unread;
            $res['accepted_count']    = $accepted;
            $res['pending_count']     = $pending;
            $res['cancelled_count']   = $cancelled;
            $res['declined_count']    = $declined;
            $res['expired_count']     = $expired;
        } else {
            $res['all_message_count'] = 0;
            $res['unread_count']      = 0;
            $res['accepted_count']    = 0;
            $res['pending_count']     = 0;
            $res['cancelled_count']   = 0;
            $res['declined_count']    = 0;
            $res['expired_count']     = 0;
        }

        return json_encode($res);
    }

    public function send_message($receiver_id, $message, $message_type = 1, $property_id = 0, $booking_id = 0)
    {
        $message = new Messages;
        if ($property_id != 0) {
            $message->property_id = $property_id;
        }
        if ($booking_id != 0) {
            $message->booking_id = $booking_id;
        }
        $message->receiver_id = $receiver_id;
        $message->sender_id = \Auth::user()->id;
        $message->message = $message;
        $message->type_id = $message_type;
        $message->save();
        return 1;
    }
    
    public function messageWithType(Request $request)
    {
        $user_id = Auth::user()->id;
        $type    = trim($request->type);

        if ($type == "all") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "unread") {
            $result =   Messages::where('receiver_id', $user_id)->where('read', 0)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "pending_requests") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->whereHas('bookings', function ($query) {
                $query->where('status', 'Pending');
            })->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "accepted_requests") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->whereHas('bookings', function ($query) {
                $query->where('status', 'Accepted');
            })->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "cancelled_requests") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->whereHas('bookings', function ($query) {
                $query->where('status', 'Cancelled');
            })->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "declined_requests") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->whereHas('bookings', function ($query) {
                $query->where('status', 'Declined');
            })->with('property_address')->orderBy('id', 'desc');
        } elseif ($type == "expired_requests") {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->whereHas('bookings', function ($query) {
                $query->where('status', 'Expired');
            })->with('property_address')->orderBy('id', 'desc');
        } else {
            $result =   Messages::where('receiver_id', $user_id)->with('sender')->with(['bookings' => function ($query) {
                                $query->with('currency');
            }])->with('property_address')->orderBy('id', 'desc');
        }

        $result =  $result->paginate(10)->toJson();

        return $result;
    }

    public function hostMessage(Request $request)
    {
        $unread   = Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->where('read', 0)->count();

        if ($unread !=0) {
            Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->update(['read' =>'1']);
        }


        $data['messages'] = Messages::with('sender', 'bookings')->where('booking_id', $request->id)->orderBy('created_at', 'desc')->get();

        $data['Properties'] = Properties::where('host_id', Auth::user()->id)->pluck('name', 'id');

        if ($data['messages'][0]->bookings->user_id == Auth::user()->id) {
            abort('404');
        }
        $data['title'] = 'Conversation';
        return view('users.host_message', $data);
    }

    public function guestMessage(Request $request)
    {
        $read_count   = Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->where('read', 0)->count();

        if ($read_count !=0) {
            Messages::where('booking_id', $request->id)->where('receiver_id', Auth::user()->id)->update(['read' =>'1']);
        }

        $data['messages'] = Messages::with('sender', 'bookings')->where('booking_id', $request->id)->orderBy('created_at', 'desc')->get();

        if ($data['messages'][0]->bookings->properties->host_id == Auth::user()->id) {
            abort('404');
        }

        $data['title'] = 'Conversation';

        return view('users.guest_message', $data);
    }

    public function reply(Request $request)
    {
        $rules = array(
            'message'      => 'required',
        );

        $fieldNames = array(
            'message'      => 'Message',
        );

        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($fieldNames);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $booking = Bookings::where('id', $request->booking_id)->first();
            $receiver = ($booking->host_id == Auth::user()->id)? $booking->user_id : $booking->host_id;
            $message = new Messages;
            $message->property_id = $booking->property_id;
            $message->booking_id = $request->booking_id;
            $message->receiver_id = $receiver;
            $message->sender_id = \Auth::user()->id;
            $message->message = $request->message;
            $message->type_id = 1;
            $message->save();
        }

        if ($booking->host_id == Auth::user()->id) {
            return redirect('messaging/host/'.$request->booking_id);
        } else {
            return redirect('messaging/guest/'.$request->booking_id);
        }
    }
    public function chatMessage(Request $request)
    {
        $unread   = Messages::where('booking_id',$request->id)->where('receiver_id',Auth::user()->id)->where('read',0)->count();

        if ($unread !=0)
            Messages::where('booking_id',$request->id)->where('receiver_id',Auth::user()->id)->update(['read' =>'1']);
        $data['messages']   = Messages::with('sender','bookings')->where('booking_id',$request->id)->orderBy('created_at','desc')->get();

        if ($data['messages'][0]->bookings->user_id != Auth::user()->id) {
           $data['Properties'] = Properties::where('host_id',Auth::user()->id)->pluck('name','id'); 
           $data['title'] = 'Conversation';
           return view('users.host_message', $data);
      } else if ($data['messages'][0]->bookings->properties->host_id != Auth::user()->id) {

      
       $data['title'] = 'Conversation';

       return view('users.guest_message', $data);

   } else {
       abort('404');

   }      
 }
}
