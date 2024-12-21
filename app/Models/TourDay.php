<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function monuments(): BelongsToMany
    {
        return $this->belongsToMany(Monument::class)
                    ->withTimestamps();
    }

    public function guide()
    {
        return $this->belongsTo(Guide::class);
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
}
