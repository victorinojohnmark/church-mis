<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_type', 'filename', 'date'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'user_id');
    }
}
