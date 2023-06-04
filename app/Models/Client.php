<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = ['name', 'birth_date', 'address', 'contact_number', 'email', 'password'];

    public function scopeList($query)
    {
        $query->where('is_admin', false);
    }

    
}
