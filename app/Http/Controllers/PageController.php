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

    public function restaurents(Request $request)
    {
        $params = $request->all();
        return view('pages.restaurents', compact('params'));
    }


    public function restaurentView($slug)
    {
        $restaurent = Restaurent::with('categories','cuisines','features','location','location.zone')
            ->whereSlug($slug)
            ->first();

        return view('pages.restaurent', compact('restaurent'));
    }


    public function restaurentFilter($type, $slug)
    {
        $pageTitle = ucfirst($type);
        $fetchUrl = url('/api/fetch/restaurents/?'.$type.'='.$slug);
        return view('pages.categorised-restaurents', compact('pageTitle','fetchUrl','type','slug'));
    }
}
