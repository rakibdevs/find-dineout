<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Zone;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {
        return Zone::has('restaurents')->withCount('restaurents')->get();
    }

    public function fetch(Request $request)
    {
        return Zone::withCount('restaurents')
            ->orderBy('restaurents_count', 'desc')
            ->get();
    }

    public function fetchLocation(Request $request)
    {
        $zone = $request->zone??'';
        $keyWord = $request->keyword??'';
        return Location::with('zone')
            ->withCount('restaurents')
            ->when($zone != '', function($q) use ($zone){
                $q->where('zone_id', $zone);
            })
            ->when($keyWord != '', function($q) use ($keyWord){
                $q->where('name','like','%'.$keyWord.'%');
                $q->orWhereHas('zone', function($p) use ($keyWord){
                    $p->where('name','like','%'.$keyWord.'%');
                });
            })
            ->orderBy('restaurents_count', 'desc')
            ->take(30)
            ->get();
    }

    public function availableLocation(Request $request)
    {
        $location = $request->location??'';
        return Location::with('zone')
            ->withCount('restaurents')
            ->when($location != '', function($q) use ($location){
                $q->where('location_id', $location);
            })
            ->orderBy('restaurents_count', 'desc')
            ->take(30)
            ->get();
    }
}
