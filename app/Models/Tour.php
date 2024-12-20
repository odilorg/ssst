<?php

// Tour Model
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'tour_duration', 'tour_description'];

    public function tourDays()
    {
        return $this->hasMany(TourDay::class);
    }
}
