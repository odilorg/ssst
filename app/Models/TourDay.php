<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

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


}
