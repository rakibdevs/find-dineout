<?php

namespace App\Http\Controllers;

use App\Models\Restaurent;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('pages.index');
    }

    public function privacy()
    {
        return view('pages.privacy-policy');
    }

    public function restaurents(Request $request)
    {
        $params = $request->all();
        return view('pages.restaurents', compact('params'));
    }


    public function restaurentView($slug)
    {
        $restaurent = Restaurent::with(
            'images',
            'menucards',
            'categories',
            'cuisines',
            'features',
            'location',
            'location.zone'
        )
        ->whereSlug($slug)
        ->first();

        $similiar = $restaurent->similiar();
        $restaurent->increment('view', 1);


        return view('pages.restaurent', compact('restaurent','similiar'));
    }


    public function restaurentFilter($type, $slug)
    {
        $pageTitle = ucfirst($type);
        $fetchUrl = url('/api/fetch/restaurents/?'.$type.'='.$slug);
        return view('pages.categorised-restaurents', compact('pageTitle','fetchUrl','type','slug'));
    }
}
