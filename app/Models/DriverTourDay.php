<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverTourDay extends Model
{
    use HasFactory;
    protected $fillable = [
        'driver_id',
        'tour_day_id',
        'amount_paid',
        'payment_date',
        'payment_status',
        'notes'
    ];
}
