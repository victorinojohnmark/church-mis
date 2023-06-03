<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class DocumentRequestConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'confirmation_date',
        'contact_number',
        'birth_date',
        'father_name',
        'mother_name',
        'address',
        'purpose',
        'requested_date'
    ];

    protected $observables = ['setReady'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function triggerSetReadyEvent()
    {
        $this->fireModelEvent('setReady', false);
    }
}