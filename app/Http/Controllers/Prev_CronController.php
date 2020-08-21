<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use Config;
use Auth;
use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Rooms;
use App\Models\Bookings;

class CronController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index()
    {
        $this->check_booking_expired();
    }

    public function check_booking_expired()
    {
        $date           = new DateTime;
        $date->modify('-24 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');

        $results = Bookings::where('created_at', '<', $formatted_date)->where('status', 'Pending')->get();
        foreach ($results as $result) {
            Bookings::where('id', $result->id)->update(['status' => 'Expired', 'expired_at' => date('Y-m-d H:i:s')]);
        }
    }
}
