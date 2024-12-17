<?php

namespace App\Models;

use App\Casts\MoneyCast;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TerminalCheck extends Model
{
    use HasFactory;


    protected $casts = [
        'amount' => MoneyCast::class,
    ];

    protected $fillable = ['tenant_id','amount', 'check_date', 'card_type', 'doc_type'];
}
