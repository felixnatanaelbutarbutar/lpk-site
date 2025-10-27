<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // <— ADD

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles; // <— ADD HasRoles

    /**
     * Mass assignable attributes.
     * Tambahkan biodata gabung di sini.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'nik',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'city',
        'province',
        'postal_code',
        'education_level',
        'emergency_contact_name',
        'emergency_contact_phone',
        'is_active',
        'deleted_by',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birth_date' => 'date',
            'is_active' => 'boolean',
        ];
    }
}
