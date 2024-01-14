<?php

namespace App\Models\Reservation;

use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funeral extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time', 'name', 'age', 'sex', 'relationship', 'status', 'religion', 
    'address', 'date_of_death', 'cause_of_death', 'cemetery', 'funeraria', 'contact_person', 'contact_number', 'created_by_id'];

    protected $observables = ['reservationAccepted', 'reservationRejected'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'created_by_id', 'id');
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
