<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Cache;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        return Cache::remember('categories', 3600 ,function () {
            return Category::withCount('restaurents')->orderByDesc("restaurents_count")->get()->toArray();
        });
    }
}
