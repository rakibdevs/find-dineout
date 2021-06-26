<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Cache;
use Illuminate\Http\Request;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Cache::remember('cuisines', 3600 ,function () {
            return Cuisine::withCount('restaurents')->get()->toArray();
        });
    }
}
