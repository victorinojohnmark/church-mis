<?php

namespace App\Models\Reservation;

use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blessing extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'blessing_type', 'date', 'time', 'religion', 'address', 'landmark', 'contact_number', 'created_by_id'];

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
