<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AirRailTourDay extends Model
{
    protected $table = 'air_rail_tour_day';

    protected $fillable = [
        'tour_day_id',
        'air_rail_id',
        'departure_time_override',
        'arrival_time_override',
        'ticket_number',
        'special_requests',
        'reservation_status',
        'cost',
        'discount',
        'total_price',
    ];

    public function tourDay(): BelongsTo
    {
        return $this->belongsTo(TourDay::class);
    }

    public function airRail(): BelongsTo
    {
        return $this->belongsTo(AirRail::class);
    }
}
