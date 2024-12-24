<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuidePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'price',
        'spok_lang_id'
       
    ];

    public function availLanguages()
    {
        return $this->belongsTo(SpokenLanguage::class, 'spok_lang_id');
    }
}
