<?php

namespace App\Models\Reservation;

use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'birth_date', 'fathers_name', 'mothers_name', 'present_address', 'contact_number', 'created_by_id'];

    protected $observables = ['reservationAccepted'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'created_by_id');
    }

    public function triggerReservationAccepted()
    {
        $this->fireModelEvent('reservationAccepted', false);
    }

}
