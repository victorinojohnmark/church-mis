<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentRequest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_type', 'requested_date'];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function parishioner()
    {
        return $this->belongsTo(Parishioner::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    
}
