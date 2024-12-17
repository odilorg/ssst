<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class Amenity extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'tenant_id'];

    public function rooms()
{
    return $this->belongsToMany(Room::class);
}

}
