<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birth_date', 'guardian', 'contact_number', 'present_address'];
}
