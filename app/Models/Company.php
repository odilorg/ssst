<?php

// Company Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'phone', 'email'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'owner_id')->where('owner_type', 'company');
    }
}