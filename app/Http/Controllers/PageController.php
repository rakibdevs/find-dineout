<?php

namespace App\Http\Controllers;

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
}
