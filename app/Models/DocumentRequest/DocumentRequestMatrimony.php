<?php

namespace App\Models\DocumentRequest;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Client;

class DocumentRequestMatrimony extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'grooms_name',
        'grooms_birth_date',
        'brides_name',
        'brides_birth_date',
        'matrimony_date',
        'contact_number',
        'address',
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
