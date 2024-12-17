<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CarDriver extends Pivot
{
    use HasFactory;

    protected $table = 'car_driver'; // Specify the pivot table name

    protected $fillable = ['car_id', 'driver_id', 'tenant_id'];

    public function car()
{
    return $this->belongsTo(Car::class);
}

public function driver()
{
    return $this->belongsTo(Driver::class);
}
}
