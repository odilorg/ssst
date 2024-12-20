<?php

// Owner Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'contact', 'email'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'owner_id');
    }

    public function driver()
    {
        return $this->hasOne(Driver::class, 'owner_id');
    }
}