<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreConfirmationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'created_by_id' => 'required|exists:users,id',
            'file' => 'required|file', // Example rule for file upload, adjust as needed
            'details' => [
                'required',
                'json',
                function ($attribute, $value, $fail) {
                    $details = json_decode($value, true);
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $fail("The $attribute must be a valid JSON object.");
                        return;
                    }
                    foreach ($details as $detail) {
                        $validator = Validator::make($detail, [
                            'name' => 'required',
                            'birth_date' => 'required',
                            'baptismal_date' => 'required',
                            'father' => 'required',
                            'mother' => 'required',
                            'sponsor_1' => 'required',
                            'sponsor_2' => 'required',
                            'contact_number' => 'required',
                            'present_address' => 'required',
                        ]);
                        if ($validator->fails()) {
                            $fail("The $attribute must have complete values for keys.");
                            return;
                        }
                    }
                },
            ],
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'created_by_id' => auth()->id()
        ]);
    }
}
