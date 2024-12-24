<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleSubCategoryPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_sub_category_id',
        'price',
        'type',
        
    ];

    public function subCategory()
{
    return $this->belongsTo(VehicleSubCategory::class, 'vehicle_sub_category_id'); 
}
}
