<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;

class SoldTourDriver extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount_paid',
        'payment_date',
        'payment_document_image',
        'payment_method',
        'tenant_id'
    ] ;
}
