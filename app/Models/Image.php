<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
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
     * Get the parent model model (Restaurent or Menu).
     */
    public function model()
    {
        return $this->morphTo();
    }
}
