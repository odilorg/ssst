<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
