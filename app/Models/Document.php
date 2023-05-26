<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'document_type', 'filename', 'date'];

    public function parishioner()
    {
        return $this->belongsTo(Parishioner::class, 'user_id');
    }
}
