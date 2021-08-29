<?php

namespace App\Models;

use App\Models\Restaurent;
use App\Traits\MakeSluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use MakeSluggable;
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

    /**
     * Get all of the restaurents's public uri.
     */
    public function getPublicUriAttribute()
    {
        return url('offers/'.$this->slug);
    }

    /**
     * A offer may be assigned to many restaurents
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function restaurents()
    {
        return $this->belongsToMany(Restaurent::class, 'restaurent_offers')
            ->withTimestamps();
    }
}
