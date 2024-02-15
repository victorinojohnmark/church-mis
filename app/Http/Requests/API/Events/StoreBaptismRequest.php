<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

use App\Rules\BaptismSpecialDate;
use App\Rules\BaptismSpecialTime;

class StoreBaptismRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required'],
            'date' => ['required', 'date', new BaptismSpecialDate()],
            'time' => ['required', new BaptismSpecialTime()],
            'sex' => ['required', 'in:Male,Female'],
            'relationship' => ['required', 'in:Grandmother,Grandfather,Mother,Father,Sibling,Other'],
            'other_relationship' => ['required_if:relationship,Other'],
            'birth_date' => ['required', 'date'],
            'place_of_birth' => ['required'],
            'is_special' => ['sometimes', 'boolean'],
            'fathers_name' => ['required'],
            'mothers_name' => ['required'],
            'present_address' => ['required'],
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
