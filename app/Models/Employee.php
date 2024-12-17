<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory;

    protected $casts = [
        'lang_spoken' => 'array',
    ];

    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone01', 'phone02', 'lang_spoken', 'image',
        'extra_info',
        'school',
        'passport_image',
        'fathers_name',
        'pinfl',
        'address',
        'tenant_id'
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(SpokenLanguage::class, 'language_employee');
    }
}
