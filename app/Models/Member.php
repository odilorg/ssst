<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'tenant_id'];
}
