<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'room_id',
        'type',
        'booking_date',
        'checkout_date',
        'selection',
        'adults',
        'children',
        'notes',
        'status',
        'check_in_date',
        'check_out_date',
        'check_in_time',
        'check_out_time',
        'total_amount',
        'payment_method',
        'receipt_path',
        'payment_status'
    ];

    protected $casts = [
        'booking_date' => 'date',
        'checkout_date' => 'date',
        'check_in_date' => 'date',
        'check_out_date' => 'date',
        'check_in_time' => 'datetime:H:i',
        'check_out_time' => 'datetime:H:i',
        'check_in_date' => 'date:Y-m-d',
        'check_out_date' => 'date:Y-m-d',
        'booking_date' => 'date:Y-m-d',
        'checkout_date' => 'date:Y-m-d'
    ];

    /**
     * Get the room that the booking belongs to.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
