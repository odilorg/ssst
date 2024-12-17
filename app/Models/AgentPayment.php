<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class AgentPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        "guide_id",
        'sold_tour_id',
        'amount_paid',
        'payment_date',
        'payment_document_image',
        'payment_method',
        'tenant_id'
    ];


    
}
