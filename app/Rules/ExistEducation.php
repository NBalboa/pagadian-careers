<?php

namespace App\Rules;

use App\Models\Education;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistEducation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (!Education::where('name', $value)->exists()) {
            $fail('The :attribute must exist in education list or must be correct spelling');
        }
    }
}
