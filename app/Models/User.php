<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Panel;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\PermissionRegistrar;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * @property string $role
 * @method bool hasRole(string $role)
 * @method bool hasAnyRole(array $roles)
 */

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    public function canAccessPanel(Panel $panel): bool
    {
        return self::where('email', $this->email)->exists(); 
        }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tenant_id'
        
    ];

    public function roles(): MorphToMany
{
    return $this->morphToMany(
        Role::class,
        'model',
        config('permission.table_names.model_has_roles'),
        config('permission.column_names.model_morph_key'),
        app(PermissionRegistrar::class)->pivotRole
    );
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Check if the user has a specific role
    // public function hasRole(string $role): bool
    // {
    //     return $this->role === $role;
    // }

    // Check if the user has any role in a list
    // public function hasAnyRole(array $roles): bool
    // {
    //     return in_array($this->role, $roles);
    // }


}
