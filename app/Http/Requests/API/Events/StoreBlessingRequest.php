<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NotOnMondayReservation;
use App\Rules\EightToFiveReservationTime;
use Illuminate\Support\Facades\Date;

class StoreBlessingRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'], 
            'blessing_type' => ['required'], 
            'date' => ['required', 'date', 'after_or_equal:' . Date::today(), new NotOnMondayReservation()], 
            'time' => ['required', new EightToFiveReservationTime()],
            'address' => ['nullable'], 
            'landmark' => ['nullable'], 
            'contact_number' => ['required','digits:11'], 
            'created_by_id' => ['required']
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'created_by_id' => auth()->id()
        ]);
    }
}
