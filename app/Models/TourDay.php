<?php

namespace App\Models;

use App\Models\AirRailTourDay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TourDay extends Model
{
    use HasFactory;

    protected $fillable = ['tour_id', 'date', 'vehicle_id', 'driver_id', 'day_name', 'description', 'image'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // public function vehiclePrice()
    // {
    //     return $this->belongsTo(VehicleSubCategoryPrice::class, 'vehicle_price_id');
    // }

    // public function vehiclePrices()
    // {
    //     return $this->hasMany(VehicleSubCategoryPrice::class, '');
    // }

    

    // public function driver()
    // {
    //     return $this->belongsTo(Driver::class);
    // }

    public function monuments(): BelongsToMany
    {
        return $this->belongsToMany(Monument::class)
                    ->withTimestamps();
    }

    public function guideLang()
    {
        return $this->belongsTo(SpokenLanguage::class, 'guide_price_id');
    }


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function airRails()
    {
        return $this->belongsToMany(AirRail::class, 'air_rail_tour_day')
                    ->withPivot([
                        'ticket_number',
                        'departure_time_override',
                        'arrival_time_override',
                        'reservation_status',
                        'special_requests',
                        'cost',
                        'discount',
                        
                        'total_price',
                    ])
                    ->withTimestamps();
    }


    public function airRailDetails(): HasMany
    {
        return $this->hasMany(AirRailTourDay::class);
    }
    

    public function vehiclePrices(): BelongsToMany
    {
        return $this->belongsToMany(VehicleSubCategoryPrice::class, 'tour_day_vehicle_sub_category_price')
                    ->withPivot([
                        'price',
                        'type',
                    ])
                    ->withTimestamps();
    }

    public function vehiclePriceDetails(): HasMany
    {
        return $this->hasMany(TourDayVehicleSubCategoryPrice::class);
    }

}
