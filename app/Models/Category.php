<?php

namespace App\Models;

use App\Models\Restaurent;
use App\Traits\MakeSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use MakeSluggable;
    /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'image'
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = ['public_uri'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at'
    ];


    /**
     * Get all of the categories's public uri.
     */
    public function getPublicUriAttribute()
    {
        return url('restaurents/categories/'.$this->slug);
    }


    /**
     * A category may be assigned to many restaurents
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function restaurents()
    {
        return $this->belongsToMany(Restaurent::class, 'restaurent_categories')
            ->withTimestamps();
    }
}
