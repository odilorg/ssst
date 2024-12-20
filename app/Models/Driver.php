<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'license_number'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'owner_id')->where('owner_type', 'driver');
    }

    public function assignedVehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'driver_vehicle')->withPivot('start_date', 'end_date');
    }

    public function tourDays()
    {
        return $this->hasMany(TourDay::class);
    }

    public function owner()
    {
        return $this->morphOne(Owner::class, 'ownerable');
    }
}