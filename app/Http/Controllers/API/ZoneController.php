<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
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
        return Location::withCount('restaurents')
            ->when($zone != '', function($q) use ($zone){
                $q->where('zone_id', $zone);
            })
            ->orderBy('restaurents_count', 'desc')
            ->take(30)
            ->get();
    }
}
