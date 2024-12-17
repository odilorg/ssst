<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class DriverPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sold_tour_id',
        'amount_paid',
        'payment_date',
        'payment_type',
        'receipt_image'
    ];
}
