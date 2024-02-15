<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BaptismSpecialDate implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $isSpecial = request()->is_special ?? false;

       // Check if the date is not in the past
       $currentDate = date('Y-m-d');
       if (strtotime($value) < strtotime($currentDate)) {
           $fail('The selected date is not applicable.');
       }

       // Check if the date is not a Monday
       $dayOfWeek = date('N', strtotime($value));
       if ($dayOfWeek == 1) {
            $fail('Monday is not applicable.');
       }

       if ($isSpecial) {
            // Check if the date is between Tuesday and Saturday
            // if special date is selected, then the date must be between Tuesday and Saturday
            $dayOfWeek = date('N', strtotime($value));
            if ($dayOfWeek >= 2 && $dayOfWeek <= 6) {
                //do nothing
            } else {
                $fail('Special reservation date for baptism must be between Tuesday and Saturday.');
            }
        } else {
            // Check if the date is a Sunday
            $dayOfWeek = date('N', strtotime($value));
            if($dayOfWeek != 7) {
                $fail('Non-special reservation date for baptism must be Sunday.');
            }
        }


    }

    
}
