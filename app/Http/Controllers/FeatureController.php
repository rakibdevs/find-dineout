<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Cache;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Cache::remember('features', 3600 ,function () {
            return Feature::withCount('restaurents')->get()->toArray();
        });
    }
}
