<?php

namespace App\Http\Requests\API\Events;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommunionRequest extends FormRequest
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
            'file' => 'required|file', // Example rule for file upload, adjust as needed
            'details' => [
                'required',
                'array',
                function ($attribute, $value, $fail) {
                    foreach ($value as $detail) {
                        $keys = ['name', 'birth_date', 'guardian', 'contact_no', 'address'];
                        foreach ($keys as $key) {
                            if (!array_key_exists($key, $detail) || empty($detail[$key])) {
                                $fail("The $attribute array must have complete values for keys.");
                                return;
                            }
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
