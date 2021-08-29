<?php

namespace App\Repositories;

use App\Models\Branch;
use App\Models\Restaurent;

class RestaurentRepository 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get($request)
    {
        $categories = isset($request->categories)?explode(",",$request->categories):[];
        $cuisines   = isset($request->cuisines)  ?explode(",",$request->cuisines):  [];
        $features   = isset($request->features)  ?explode(",",$request->features):  [];
        $per_page   = isset($request->per_page)  ?$request->per_page: 12;
        // fetch restaurents of current location
        $location = 1;
        
        return Restaurent::with([
                'categories' => function ($query) {
                    $query->select('name', 'slug');
                },
                'features' => function ($query) {
                    $query->select('name', 'slug');
                },
                'cuisines' => function ($query) {
                    $query->select('name', 'slug');
                },
                'location',
                'location.zone'
            ])
            ->when(!empty($categories), function($query) use ($categories){
                $query->whereHas('categories', function($q) use ($categories){
                    $q->whereIn('slug', $categories);
                });
            })
            ->when(!empty($features), function($query) use ($features){
                $query->whereHas('features', function($q) use ($features){
                    $q->whereIn('slug', $features);
                });
            })
            ->when(!empty($cuisines), function($query) use ($cuisines){
                $query->whereHas('cuisines', function($q) use ($cuisines){
                    $q->whereIn('slug', $cuisines);
                });
            })
            //->where('location_id', $location)
            ->paginate($per_page);
    }

    
}
