<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SpokenLanguage extends Model
{
    use HasFactory;

    protected $fillable = ['language', 'tenant_id'];

    public function guidePrice(): HasOne
    {
        return $this->hasOne(GuidePrice::class);
    }
    
}
