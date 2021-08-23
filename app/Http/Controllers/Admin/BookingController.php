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
            ->when($keyword != '', function($q) use ($keyword){
                $q->where('booking_code','like','%'.$keyword.'%')
                  ->orWhere('guest_name','like','%'.$keyword.'%')
                  ->orWhere('mobile_no','like','%'.$keyword.'%')
                  ->orWhereHas('restaurent', function($q) use ($keyword){
                        $q->where('name','like','%'.$keyword.'%');
                    });
            })
            ->orderBy('id','desc')
            ->paginate($perpage);
    }


    public function dailyBooking(Request $request)
    {
        $days = $request->days??6;
        return $this->countGroupedByDay(Booking::class, $days);
    }
}


