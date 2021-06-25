<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Cuisine;
use App\Models\Feature;
use App\Models\Image;
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
    protected $appends = ['cover_src'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];

    /**
     * Get all of the restaurents's images.
     */
    public function getCoverSrcAttribute()
    {
        return isset($this->cover)?asset($this->cover):asset('images/resource/dummy-restaurent.jpg');
    }

    /**
     * A restaurent may has many features
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function features()
    {
        return $this->belongsToMany(Feature::class, 'restaurent_features')
            ->withTimestamps();
    }

    /**
     * A restaurent may has many categories
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'restaurent_categories')
            ->withTimestamps();
    }

    /**
     * A restaurent may has many types of cuisines
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function cuisines()
    {
        return $this->belongsToMany(Cuisine::class, 'restaurent_cuisines')
            ->withTimestamps();
    }

    /**
     * A restaurent may has to many branches
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }


    /**
     * Get all of the restaurents's images.
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}