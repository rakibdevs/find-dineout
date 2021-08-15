<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cuisine;
use Illuminate\Http\Request;
use Cache;

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
            return Cuisine::withCount('restaurents')->orderByDesc("restaurents_count")->get()->toArray();
        });
    }
}
