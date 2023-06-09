<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;


class User extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = ['name', 'birth_date', 'address', 'contact_number', 'email', 'password', 'is_admin'];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime', 
        'password' => 'hashed',
    ];

    public function scopeClient($query)
    {
        $query->where('is_admin', false);
    }
}
