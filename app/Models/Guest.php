<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Guest extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
         'last_name', 
         'email', 
         'phone', 
         'country',
         'amount_paid',
         'payment_date',
         'payment_document_image',
         'payment_method',
         'tenant_id'
        ];
        public function bookings(): HasMany
        {
            return $this->hasMany(Booking::class);
        }
       
}
