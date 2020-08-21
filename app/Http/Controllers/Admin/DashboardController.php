<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Properties;
use App\Models\Bookings;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        
        $data['total_users_count']        = User::count();
        $data['total_property_count']     = Properties::count();
        $data['total_reservations_count'] = Bookings::count();

        $data['today_users_count']        = User::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['today_property_count']     = Properties::whereDate('created_at', DB::raw('CURDATE()'))->count();
        $data['today_reservations_count'] = Bookings::whereDate('created_at', DB::raw('CURDATE()'))->count();

        $properties = new Properties;
        $data['propertiesList'] = $properties->getLatestProperties();

        $bookings = new Bookings;
        $data['bookingList'] = $bookings->getBookingLists();
        return view('admin.dashboard', $data);
    }
}
