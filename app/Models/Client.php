<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Models\Reservation\Baptism;
use App\Models\Reservation\Communion;

class Client extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = ['name', 'birth_date', 'address', 'contact_number', 'sex' , 'email', 'password'];

    public function scopeList($query)
    {
        $query->where('is_admin', false);
    }

    public function baptism()
    {
        return $this->hasMany(Baptism::class, 'created_by_id');
    }

    public function communion()
    {
        return $this->hasMany(Communion::class, 'created_by_id');
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('is_admin', false);
    }

    
}
