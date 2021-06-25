<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
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
    protected $appends = ['image_src'];

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
    public function getImageSrcAttribute()
    {
        return isset($this->image)?asset($this->image):asset('images/resource/no-image.jpg');
    }
}
