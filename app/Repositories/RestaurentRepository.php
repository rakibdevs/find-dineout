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
            ->whereHas('restaurent.categories', function($query) use ($categories){
                $query->when(!empty($categories), function($q) use ($categories) {
                    $q->whereIn('name', $categories);
                });
            })
            ->whereHas('restaurent.features', function($query) use ($features){
                $query->when(!empty($features), function($q) use ($features) {
                    $q->whereIn('name', $features);
                });
            })
            ->whereHas('restaurent.cuisines', function($query) use ($cuisines){
                $query->when(!empty($cuisines), function($q) use ($cuisines) {
                    $q->whereIn('name', $cuisines);
                });
            })
            ->where('location_id', $location)
            ->paginate(12);
    }

    
}
