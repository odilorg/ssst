<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'chat_id', 'tenant_id'];
}
