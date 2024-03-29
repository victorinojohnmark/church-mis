<?php

namespace App\Models\Reservation;

use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baptism extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'time', 'sex', 'relationship', 'other_relationship', 'place_of_birth', 'is_special', 'birth_date', 'fathers_name', 'mothers_name', 'sponsor_1', 'sponsor_2', 'present_address', 'contact_number', 'created_by_id'];

    protected $observables = ['reservationAccepted', 'reservationRejected'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'created_by_id', 'id');
    }

    public function scopeAccepted($query)
    {
        return $query->where('is_accepted', true);
    }

    public function getStatusAttribute()
    {
        if($this->is_accepted){
            return 'Accepted';
        } elseif($this->is_rejected) {
            return 'Rejected';
        } else {
            return 'Pending';
        }
    }

    public function triggerReservationAccepted()
    {
        $this->fireModelEvent('reservationAccepted', false);
    }

    public function triggerReservationRejected()
    {
        $this->fireModelEvent('reservationRejected', false);
    }

}
