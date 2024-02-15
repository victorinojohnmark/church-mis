<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;

use App\Rules\NotOnMondayReservation;

class StoreMatrimonyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'grooms_name' => ['required'],
            'grooms_birth_date' => ['required', 'date'],
            'brides_name' => ['required'],
            'brides_birth_date' => ['required', 'date'],
            'time' => ['required', 'in:07:30,09:00,10:30,16:00,07:30:00,09:00:00,10:30:00,16:00:00'],
            'wedding_date' => [
                'required',
                'date',
                new NotOnMondayReservation(),
                'after_or_equal:' . Date::today(),
                Rule::unique('matrimonies')->where(function ($query) {
                        return $query->where('wedding_date', request()->wedding_date)
                            ->where('time', request()->time);
                    }),
            ],
            'relationship' => ['required', 'in:Mother,Father,Partner,Other'],
            'other_relationship' => ['required_if:relationship,Other'],
            'contact_number' => ['required', 'digits:11'],
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
