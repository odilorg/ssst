<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class BookingDriver extends Model
{
    use HasFactory;

    

    protected $fillable = [ 
        'driver_id',
         'booking_id',
         'tenant_id'
          
    ];
}
