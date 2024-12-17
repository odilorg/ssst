<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    /**
     * Automatically apply the tenant_id scope.
     */
    protected static function booted()
    {
        static::addGlobalScope('tenant', function (Builder $builder) {
            if (auth()->check() && session()->has('current_tenant_id')) {
                $builder->where('tenant_id', session('current_tenant_id'));
            } elseif (session()->has('current_tenant_id')) {
                $builder->where('tenant_id', session('current_tenant_id'));
            } else {
                // If no session or auth, apply a default tenant_id
                $builder->where('tenant_id', 1); // Replace 1 with a sensible default tenant ID
            }
        });
    }

    /**
     * Ensure all models fill tenant_id when creating.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check() && session()->has('current_tenant_id')) {
                $model->tenant_id = session('current_tenant_id');
            } elseif (session()->has('current_tenant_id')) {
                $model->tenant_id = session('current_tenant_id');
            } else {
                // Fallback tenant_id if no session or auth is available
                $model->tenant_id = 1; // Replace 1 with a sensible default tenant ID
            }
        });
    }

    /**
     * Remove the tenant scope for specific queries.
     */
    public static function withoutTenantScope()
    {
        return static::withoutGlobalScope('tenant');
    }
}
