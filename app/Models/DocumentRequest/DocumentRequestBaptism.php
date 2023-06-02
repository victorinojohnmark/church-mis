<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequestBaptism extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'baptismal_date',
        'contact_number',
        'birth_date',
        'father_name',
        'mother_name',
        'address',
        'purpose',
        'requested_date'
    ];
}
