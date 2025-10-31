<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /** 🔗 Relasi many-to-many ke tabel roles */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')
                    ->withTimestamps()
                    ->withPivot(['is_active']);
    }

    /** 🔍 Cek apakah user punya role tertentu */
    public function hasRole($roleName): bool
    {
        if (is_array($roleName)) {
            return $this->roles()->whereIn('nama', $roleName)->exists();
        }
        return $this->roles()->where('nama', $roleName)->exists();
    }

    /** 🧩 Helper untuk assign role */
    public function assignRole($roleName)
    {
        $role = Role::where('nama', $roleName)->first();
        if ($role && !$this->hasRole($roleName)) {
            $this->roles()->attach($role->id, ['is_active' => true]);
        }
    }
}
