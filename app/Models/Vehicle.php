<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['license_plate', 'type', 'owner_type', 'owner_id', 'make', 'model', 'color', 'image'];

    public function owner()
    {
        return $this->morphTo();
    }

    public function drivers()
    {
        return $this->belongsToMany(Driver::class, 'driver_vehicle')->withPivot('start_date', 'end_date');
    }

    public function tourDays()
    {
        return $this->hasMany(TourDay::class);
    }
}
