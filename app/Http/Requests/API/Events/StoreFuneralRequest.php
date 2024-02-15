<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Date;

use App\Rules\NotOnMondayReservation;

class StoreFuneralRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date' => [
                'required',
                'date',
                'after_or_equal:' . Date::today(),
                new NotOnMondayReservation(),
                Rule::unique('funerals')->where(function ($query) {
                        return $query->where('date', request()->date)
                            ->where('time', request()->time);
                    }),
            ],
            'time' => ['required', 'in:13:00,14:00,15:00,13:00:00,14:00:00,15:00:00'],
            'name' => ['required'],
            'age' => ['required'],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Other'],
            'other_relationship' => ['required_if:relationship,Other'],
            'status' => ['required'],
            'address' => ['required'],
            'date_of_death' => ['required', 'date'],
            'cause_of_death' => ['required'],
            'cemetery' => ['required'],
            'funeraria' => ['required'],
            'contact_person' => ['required'],
            'contact_number' => ['required', 'digits:11'],
            'created_by_id' => ['required'],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'created_by_id' => auth()->id()
        ]);
    }
}
