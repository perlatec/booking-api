<?php

namespace App\Models\Booking;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $table = 'booking_offers';
    protected $guarded = ['id'];

    /**
     * -----------------------------------------
     *	Relations
     * -----------------------------------------
     */

    /**
     * provider
     *
     * @return Provider
     */
    public function provider(): Provider|BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
