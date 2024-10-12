<?php

namespace App\Livewire\Applicant;

use App\Enums\ApplicantGender;
use App\Enums\EducationAttainment;
use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $applicant;
    public $applicant_educations;
    public $applicant_skills;
    public $applicant_experiences;
    public $address;
    public function mount()
    {
        $this->applicant = Applicant::with('user')->where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_educations = $this->applicant->educations()->get()->toArray();
        $this->applicant_skills = $this->applicant->skills()->get()->toArray();
        $this->applicant_experiences = $this->applicant->experiences()->get();
        $this->address = $this->applicant->address()->get()->first();
    }

    public function deleteExperience($id)
    {
        $experience = $this->applicant->experiences()->where('id', $id)->firstOrFail();
        $experience->delete();
        return redirect('/my/profile/');
    }

    public function removeApplicantSkill($id)
    {
        $this->applicant->skills()->detach([$id]);
        return redirect('/my/profile');
    }
    public function removeApplicantEducation($id)
    {
        $this->applicant->educations()->detach([$id]);

        return redirect('/my/profile');
    }
    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }

    public function getEduAttainment($value)
    {
        return EducationAttainment::fromValue($value)->stringValue();
    }
    public function render()
    {
        return view('livewire.applicant.profile')->layout(Layouts::APPLICANT->value);
    }
}
