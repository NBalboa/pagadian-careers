<?php

namespace App\Rules;

use App\Models\Education;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotExistEducation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (Education::where('name', $value)->exists()) {
            $fail('The :attribute must not exist in education list');
        }
    }
}
