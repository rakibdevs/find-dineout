<?php

namespace App\Models;

use App\Models\Location;
use App\Models\Restaurent;
use App\Traits\MakeSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use MakeSluggable;
     /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'lon', 'lat'
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
     * A zone may has to many locations
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * A zone may has to many locations and location has many restaurents
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function restaurents()
    {
        return $this->hasManyThrough(Restaurent::class,Location::class);
    }
}
