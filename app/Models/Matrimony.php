<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrimony extends Model
{
    use HasFactory;

    protected $fillable = ['grooms_name', 'grooms_birth_date', 'brides_name', 'brides_birth_date', 'wedding_date', 'contact_number', 'created_by_id'];
}
