<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bookings');
    }


    public function fetch(Request $request)
    {
        $perpage = $request->per_page != ''? ((int)$request->per_page):10;
        $keyword = $request->keyword??'';
        return Booking::with('restaurent')
            ->whereHas('restaurent', function($q) use ($keyword){
                $q->where('name','like','%'.$keyword.'%');
            })
            ->orderBy('id','desc')
            ->paginate($perpage);
    }


    public function dailyBooking(Request $request)
    {
        $days = $request->days??7;
        $date = \Carbon\Carbon::today()->subDays($days);

        $booking = Booking::selectRaw("COUNT(*) booking, DATE_FORMAT(created_at, '%Y-%m-%e') date")
            ->where('created_at', '>=', $date)
            ->groupBy('date')
            ->pluck('booking','date');

        dd($booking);
    }
}


