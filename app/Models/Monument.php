<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Monument extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'tenant_id',
        'image',
        'location_city'
    ];

    public function tourDays(): BelongsToMany
    {
        return $this->belongsToMany(TourDay::class, 'monument_tour_day')
                    ->withTimestamps();
    }
}
