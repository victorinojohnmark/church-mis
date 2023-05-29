<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = ['name', 'birth_date', 'address', 'contact_number', 'email', 'password'];

    public function scopeList($query)
    {
        $query->where('is_admin', false);
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'user_id');
    }
}
