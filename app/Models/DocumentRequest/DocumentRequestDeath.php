<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class DocumentRequestDeath extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'status',
        'religion',
        'date_of_death',
        'cause_of_death',
        'address',
        'contact_person',
        'contact_number',
        'requested_date'
    ];

    protected $observables = ['setReady'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function getStatusAttribute()
    {
        if($this->is_active) {
            if($this->is_ready) {
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
}
