<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheduledMessage extends Model
{
    use HasFactory;

    protected $fillable = ['tenant_id','message', 'scheduled_at', 'chat_id', 'frequency', 'status' ];

    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }



}
