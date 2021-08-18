<?php

namespace App\Models;

use App\Models\Restaurent;
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



    protected $appends = ['booking_schedule'];

    /**
     * get the modified booking schedule.
     *
     * @param string $value
     * @return mixed
     */


    public function getBookingScheduleAttribute()
    {
        return \Carbon\Carbon::parse($this->booking_date.' '.$this->booking_time)->format('d M, Y h:i A');
    }

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


    /**
     * A booking is assigned to restaurent
     *
     * @return  \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function restaurent()
    {
        return $this->belongsTo(Restaurent::class);
    }
}
