<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Reservation\Communion;

class CommunionDetail extends Model
{
    use HasFactory;

    protected $fillable = ['communion_id', 'name', 'birth_date', 'guardian', 'contact_number', 'present_address'];

    public function communion()
    {
        return $this->belongsTo(Communion::class, 'communion_id', 'id');
    }
}
