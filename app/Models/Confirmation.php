<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'birth_date', 'fathers_name', 'mothers_name', 'present_address', 'contact_number', 'created_by_id'];

}
