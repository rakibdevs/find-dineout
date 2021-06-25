<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurent extends Model
{
    
     /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $hidden = [
        'id'
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * A restaurent may has many features
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class)
            ->withTimestamps();
    }

    /**
     * A restaurent may has many categories
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
    }

    /**
     * A restaurent may has many types of cuisines
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class)
            ->withTimestamps();
    }
}
