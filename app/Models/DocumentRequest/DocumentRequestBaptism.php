<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

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
        'requested_date',
        'is_rejected',
        'rejection_message'
    ];

    protected $observables = ['setReady', 'reject'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function getStatusAttribute()
    {
        if($this->is_active) {
            if($this->is_rejected) {
                return 'Rejected';
            } elseif($this->is_ready) {
                return 'Ready for pick up';
            } else {
                return 'Pendings';
            }
            
        } else {
            return 'Cancelled by Client';
        }
    }

    public function triggerSetReadyEvent()
    {
        $this->fireModelEvent('setReady', false);
    }

    public function triggerRejectEvent()
    {
        $this->fireModelEvent('reject', false);
    }
}
