<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Booking extends Pivot
{
    protected $fillable = ['booker_id', 'booked_id'];

    protected $table = 'bookings';

    public function client()
    {
        return $this->belongsTo(User::class, 'booker_id');
    }

    public function counsellor()
    {
        return $this->belongsTo(User::class, 'booked_id');
    }
}
