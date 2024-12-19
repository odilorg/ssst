<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TourDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_name',
        'tour_id',
        'description',
        'tenant_id',
        'image',
        'car_id',
        'hotel_id',
        'guide_id'

    ];

// In TourDay model
public function tour()
{
    return $this->belongsTo(Tour::class);
}

public function driver()
{
    return $this->belongsTo(Driver::class);
}

public function cars()
{
    return $this->belongsToMany(Car::class, 'car_tour_day', 'tour_day_id', 'car_id');
}

public function hotels(): BelongsToMany
{
    return $this->belongsToMany(Hotel::class);
}

public function guides(): BelongsToMany
{
    return $this->belongsToMany(Guide::class);
}

public function monuments(): BelongsToMany
    {
        return $this->belongsToMany(Monument::class, 'monument_tour_day')
                    ->withTimestamps();
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

}
