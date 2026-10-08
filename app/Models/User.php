<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'show_online_status' => 'boolean',
            'password' => 'hashed',
        ];
    }

    public function dealer(): HasOne
    {
        return $this->hasOne(Dealer::class);
    }
    public function hasRole(string ...$roles): bool
{
    return in_array($this->role, $roles, true);
}

public function isAdmin(): bool
{
    return $this->role === 'admin';
}

public function isStaff(): bool
{
    return $this->role === 'staff';
}
}