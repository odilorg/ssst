<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hotel extends Model
{
    use HasFactory;

    public function rooms(): HasMany
{
    return $this->hasMany(Room::class);
}
protected $fillable = [
    'name',
     'description',
     'room_quantity',
     'number_people',
     'location',
     'address',
     'phone',
     'email',
     'website',
     'director_name',
     'official_name',
        'account_number',
        'bank_name',
        'inn',
        'bank_mfo',
        'tenant_id'

    ];

}
