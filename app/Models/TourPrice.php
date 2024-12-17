<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class TourPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_people',
        'tour_price'
    ];
}
