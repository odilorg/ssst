<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSubCategory extends Model
{
    use HasFactory;
     protected $fillable = ['name', 'category_id'];

     public function category()
    {
        return $this->belongsTo(VehicleCategory::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function price()
    {
        return $this->hasOne(VehicleSubCategoryPrice::class);
    } 
}
