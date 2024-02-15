<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EightToFiveReservationTime implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $time = date('H:i', strtotime(request()->time));
        if($time < '08:00' || $time > '17:00') {
            $fail('Reservation time must be between 8:00am and 5:00pm.');
        }
    }
}
