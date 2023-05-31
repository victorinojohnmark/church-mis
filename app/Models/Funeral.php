<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'name', 'age', 'status', 'religion', 
    'address', 'date_of_death', 'cause_of_death', 'cemetery', 'funeraria', 'contact_person', 'contact_number', 'created_by_id'];

    
}
