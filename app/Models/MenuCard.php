<?php

namespace App\Models;

use App\Models\Restaurent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCard extends Model
{
    use HasFactory;

    /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $protected = [
        'id'
    ];

    protected $guarded = [
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
     * 
     */
    public function restaurent()
    {
        return $this->belongsTo(Restaurent::class);
    }
}
