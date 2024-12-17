<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class BaseModel extends Model
{
    // Automatically apply the tenant_id scope
    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check() && session()->has('current_tenant_id')) {
                $builder->where('tenant_id', session('current_tenant_id'));
            }
        });
    }

    // Ensure all models fill tenant_id when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check() && session()->has('current_tenant_id')) {
                $model->tenant_id = session('current_tenant_id');
            }
        });
    }
}
