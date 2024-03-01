<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Reservation\Confirmation;

class ConfirmationDetail extends Model
{
    use HasFactory;

    protected $fillable = ['confirmation_id', 'name', 'birth_date', 'baptismal_date', 'father', 'mother', 'sponsor_1', 'sponsor_2', 'contact_number', 'present_address'];

    public function confirmation()
    {
        return $this->belongsTo(Confirmation::class, 'confirmation_id', 'id');
    }
}
