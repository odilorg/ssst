<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Rating;
use App\Models\CarDriver;
use App\Models\SupplierPayment;
use App\Models\TourRepeaterDriver;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Driver extends Model
{
    use HasFactory;
    protected $fillable = ['tenant_id', 'address_city', 'extra_details', 'car_id', 'first_name', 'last_name', 'email', 'phone01', 'phone02', 'fuel_type', 'driver_image'];

    
    // public function carsplates(): HasMany
    // {
    //     return $this->hasMany(CarDriver::class);
    // }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
    public function cars(): BelongsToMany
    {
        return $this->belongsToMany(Car::class);
    }

    public function tourDays()
{
    return $this->belongsToMany(TourDay::class, 'driver_tour_day', 'driver_id', 'tour_day_id');
}


    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

   

    // public function tour_repeater_driver(): HasOne
    // {
    //     return $this->hasOne(TourRepeaterDriver::class);
    // }

//     public function soldTours()
//     {
//         return $this->belongsToMany(SoldTour::class, 'sold_tour_driver')
//                     ->withPivot('amount_paid', 'payment_date', 'payment_method')
//                     ->withTimestamps();
//     }
//     public function tourRepeaterDrivers()
//     {
//         return $this->hasMany(TourRepeaterDriver::class);
//     }
//     public function tours()
//     {
//         return $this->hasManyThrough(
//             Tour::class,
//             SoldTour::class,
//             'id', // Foreign key on the SoldTour table
//             'id', // Foreign key on the Tour table
//             'id', // Local key on the Driver table
//             'tour_id' // Local key on the SoldTour table
//         );
//     }

//     public function getTotalAmountPaidAttribute()
// {
//     return $this->soldTours()->sum('amount_paid');
// }
    
}
