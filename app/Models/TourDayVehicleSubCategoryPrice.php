<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourDayVehicleSubCategoryPrice extends Model
{
    use HasFactory;

    protected $table = 'vehicle_sub_category_prices';

    protected $fillable = [
        'tour_day_id',
        'vehicle_sub_category_price_id',
        'price',
        'type',
    ];

    public function tourDay(): BelongsTo
    {
        return $this->belongsTo(TourDay::class);
    }
    public function vehicleSubCategoryPrice()
    {
        return $this->belongsTo(VehicleSubCategoryPrice::class);
    }
   

    // public function airRail(): BelongsTo
    // {
    //     return $this->belongsTo(AirRail::class);
    // }
}
