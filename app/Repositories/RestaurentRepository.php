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
            ->when(!empty($categories), function($query) use ($categories){
                $query->whereHas('restaurent.categories', function($q) use ($categories){
                    $q->whereIn('slug', $categories);
                });
            })
            ->when(!empty($features), function($query) use ($features){
                $query->whereHas('restaurent.features', function($q) use ($features){
                    $q->whereIn('slug', $features);
                });
            })
            ->when(!empty($cuisines), function($query) use ($cuisines){
                $query->whereHas('restaurent.cuisines', function($q) use ($cuisines){
                    $q->whereIn('slug', $cuisines);
                });
            })
            ->where('location_id', $location)
            ->paginate($per_page);


            /*->when(!empty($cuisines), function($query) use ($cuisines){
                $query->join('restaurent_cuisines','restaurent_cuisines.restaurent_id','branches.restaurent_id')
                    ->join('cuisines', 'restaurent_cuisines.cuisine_id', 'cuisines.id')
                    ->whereIn('cuisines.slug', $cuisines);
            })*/
    }

    
}
