<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class DocumentRequestCommunion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'communion_date',
        'contact_number',
        'birth_date',
        'sex',
        'relationship',
        'father_name',
        'mother_name',
        'address',
        'purpose',
        'requested_date'
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
                return 'Pending';
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
