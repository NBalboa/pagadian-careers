<?php

namespace App\Rules;

use App\Models\Applicant;
use App\Models\Education;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class UniqueApplicantEducation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //

        $applicant = Applicant::where('user_id', Auth::user()->id)->first();
        $education = Education::where('name', $value)->first();
        if ($education) {
            $educationExist = $applicant->educations()->find($education->id);
            if ($educationExist) {
                $fail('The :attribute already on your profile');
            }
        }
    }
}
