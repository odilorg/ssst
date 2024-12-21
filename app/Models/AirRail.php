<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirRail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',       // plane or train
        'name',
        'departure_location',
        'arrival_location',
        'departure_time',
        'arrival_time',
        'price',
        'seat_class', // economy, business, etc.
        'capacity'
    ];

    public function tourDays()
    {
        return $this->belongsToMany(TourDay::class, 'air_rail_tour_day')
                    ->withPivot([
                        'ticket_number',
                        'departure_time_override',
                        'arrival_time_override',
                        'seat_number',
                        'reservation_status',
                        'special_requests',
                        'cost',
                        'discount',
                        'tax',
                        'total_price'
                    ])
                    ->withTimestamps();
    }
}
