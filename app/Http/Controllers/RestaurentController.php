<?php

namespace App\Http\Controllers;

use App\Models\Branch;
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
        // fetch restaurents of current location
        $location = 1;
        return Branch::with([
                'restaurent',
                'restaurent.categories' => function ($query) {
                    $query->select('name', 'slug');
                },
                'restaurent.features' => function ($query) {
                    $query->select('name', 'slug');
                },
                'restaurent.cuisines' => function ($query) {
                    $query->select('name', 'slug');
                },
                'location',
                'location.zone'
            ])
            ->where('location_id', $location)
            ->paginate(5);
    }

    
}
