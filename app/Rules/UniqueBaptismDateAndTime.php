<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

use App\Models\Reservation\Baptism;

class UniqueBaptismDateAndTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //check first if special date is selected
        $isSpecial = request()->is_special ?? false;

        $baptism = Baptism::where('date', '=', $value)->where('time', '=', request()->time)->first();
        if($baptism && $isSpecial) {
            $fail('The selected date and time is already reserved.');
        }

        
    }
}
