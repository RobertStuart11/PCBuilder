<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone', 'address',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // Relasi
    public function components()
    {
        return $this->hasMany(Component::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Helper role
    public function isAdmin(): bool   { return $this->role === 'admin'; }
    public function isSeller(): bool  { return $this->role === 'seller'; }
    public function isBuyer(): bool   { return $this->role === 'buyer'; }
}