<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelTourDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'hotel_id',
        'tour_day_id',
        'amount_paid',
        'payment_date',
        'payment_status',
        'notes'
    ];
}
