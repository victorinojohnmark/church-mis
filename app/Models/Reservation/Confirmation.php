<?php

namespace App\Models\Reservation;

use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\ConfirmationDetail;

class Confirmation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'birth_date', 'fathers_name', 'mothers_name', 'present_address', 'contact_number', 'file', 'created_by_id'];

    protected $observables = ['reservationAccepted', 'reservationRejected'];

    public function details()
    {
        return $this->hasMany(ConfirmationDetail::class);
    }
    
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
