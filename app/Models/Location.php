<?php

namespace App\Models;

use App\Models\Branch;
use App\Models\Restaurent;
use App\Models\Zone;
use App\Traits\MakeSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use MakeSluggable;
     /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'lon', 'lat', 'district_id'
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
     * A location assigned to zone
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    /**
     * A location assigned to many restaurent branches
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    /**
     * A location assigned to many restaurents
     *
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function restaurents()
    {
        return $this->hasMany(Restaurent::class);
    }
}
