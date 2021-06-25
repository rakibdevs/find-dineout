<?php

namespace App\Models;

use App\Models\Restaurent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
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
     * A branch assigned to restaurent
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function restaurent()
    {
        return $this->belongsTo(Restaurent::class);
    }

    /**
     * A branch belongs to loction
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
