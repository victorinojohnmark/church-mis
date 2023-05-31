<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blessing extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'blessing_type', 'date', 'time', 'religion', 'address', 'landmark', 'contact_number', 'created_by_id'];
}
