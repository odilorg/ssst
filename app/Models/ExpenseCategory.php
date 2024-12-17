<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class ExpenseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
}
