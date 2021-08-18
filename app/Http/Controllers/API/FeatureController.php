<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            return Feature::withCount('restaurents')->orderByDesc("restaurents_count")->get()->toArray();
        });
    }
}
