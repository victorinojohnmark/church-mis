<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BaptismSpecialTime implements ValidationRule
{

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
       $isSpecial = request()->is_special ?? false;

       if ($isSpecial) {
            // Check if the time is between 8am and 5pm
            // If special date is selected, then the time must be between 8am and 5pm
            $time = date('H:i', strtotime(request()->time));
            if ($time < '08:00' || $time > '17:00') {
                $fail('Avaliable time for special schedule for baptisms is between 8am and 5pm.');
            }
        } else {
            // Check if the time is 10am
            $time = date('H:i', strtotime(request()->time));

            if($time != '10:00') {
                $fail('Available time for non-special schedule for baptisms is 10am.');
            }
        }


    }

    
}
