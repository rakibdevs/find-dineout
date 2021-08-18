<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * Auto-apply mass assignment protection
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * Set the booking code.
     *
     * @param string $value
     * @return mixed
     */


    public function setBookingCodeAttribute($value)
    {
        $lastId = static::orderBy('id','DESC')->first()->id??0;
        $code = '#FM'.str_pad(($lastId + 1), 7, "0", STR_PAD_LEFT);
        $this->attributes['booking_code'] = $code;
    }
}
