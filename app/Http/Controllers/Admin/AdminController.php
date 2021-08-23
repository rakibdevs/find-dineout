<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Restaurent;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard.index');
    }

    public function dashboardStatistics()
    {
        $restaurent = Restaurent::selectRaw("sum(view) as views, count(*) as count")->first();
        $booking = Booking::selectRaw("count(*) as count, SUM(CASE WHEN booking_date = CURRENT_DATE() THEN 1 ELSE 0 END) as todays_booking")->first();

        return [
            'total_restaurent' => $restaurent->count,
            'restaurent_views' => $restaurent->views,
            'todays_booking' => $booking->todays_booking,
            'total_booking' => $booking->count
        ];
    }
}
