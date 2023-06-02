<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'document_type', 'requested_date'];

    protected $observables = ['setReady'];

    public function createdBy()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }

    public function getStatusAttribute() {
        if($this->is_ready) {
            return true;
        } else {
            return false;
        }
    }

    public function triggerDocumentReady()
    {
        $this->fireModelEvent('setReady', false);
    }
}