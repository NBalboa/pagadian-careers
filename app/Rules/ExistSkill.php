<?php

namespace App\Rules;

use App\Models\Skill;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistSkill implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        if (!Skill::where('name', $value)->exists()) {
            $fail('The :attribute must exist in skills list or must be correct spelling');
        }
    }
}
