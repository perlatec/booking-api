<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'booking_providers';
    protected $guarded = ['id'];

    /**
     * -----------------------------------------
     *	Relations
     * -----------------------------------------
     */
}
