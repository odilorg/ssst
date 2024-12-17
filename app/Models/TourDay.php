<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TourDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_name',
        'tour_id',
        'description',
        'tenant_id',
        'image'
    ];

// In TourDay model
public function tour()
{
    return $this->belongsTo(Tour::class);
}

public function car()
{
    return $this->belongsTo(Car::class);
}

public function hotel()
{
    return $this->belongsTo(Hotel::class);
}
}
