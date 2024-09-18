<?php

namespace App\Rules;

use App\Models\Applicant;
use App\Models\Skill;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class UniqueApplicantSkill implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $applicant = Applicant::where('user_id', Auth::user()->id)->first();
        $skill = Skill::where('name', $value)->first();
        if ($skill) {
            $skillExist = $applicant->skills()->find($skill->id);
            if ($skillExist) {
                $fail('The :attribute already on your profile');
            }
        }
    }
}
