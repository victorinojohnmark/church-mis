<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_request_id', 'amount', 'proof_of_payment_file'];

    public function documentRequest()
    {
        return $this->belongsTo(DocumentRequest::class);
    }

    public function parishioner()
    {
        return $this->belongsTo(Parishioner::class, 'user_id');
    }

    public function scopeIsActive($query)
    {
        return $query->whereHas('documentRequest', function ($query) {
            $query->where('is_active', true);
        });
    }


}
