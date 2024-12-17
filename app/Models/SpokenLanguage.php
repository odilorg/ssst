<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class SpokenLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['language', 'tenant_id'];
}
