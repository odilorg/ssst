<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class CarBrand extends Model
{
    use HasFactory;

    protected $fillable = [
         'brand_name',
         'number_seats',
         'number_luggage'

        ];
}
