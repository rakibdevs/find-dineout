<?php

namespace App\Http\Controllers;

use App\Models\Restaurent;
use Illuminate\Http\Request;

class RestaurentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch()
    {
        return Restaurent::with([
                'categories' => function ($query) {
                    $query->select('name', 'slug');
                },
                'features'=> function ($query) {
                    $query->select('name', 'slug');
                },
                'cuisines'=> function ($query) {
                    $query->select('name', 'slug');
                }
            ])
            ->paginate(5);
    }

    
}
