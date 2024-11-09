<?php

namespace App\Livewire\Admin;

use App\Enums\ApplicantGender;
use App\Enums\EducationAttainment;
use App\Enums\IsVerified;
use App\Enums\Layouts;
use App\Models\Applicant;
use Livewire\Component;

class ApplicantProfile extends Component
{
    public Applicant $applicant;
    public $applicant_educations;
    public $applicant_skills;
    public $applicant_experiences;
    public $address;
    public $VERIFIED_YES = IsVerified::YES->value;

    public function mount(Applicant $applicant)
    {
        $this->applicant = $applicant;
        // dd($this->applicant);
        $this->applicant_educations = $this->applicant->educations()->get()->toArray();
        $this->applicant_skills = $this->applicant->skills()->get()->toArray();
        $this->applicant_experiences = $this->applicant->experiences()->get();
        $this->address = $this->applicant->address()->get()->first();
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
        return view('livewire.admin.applicant-profile')->layout(Layouts::ADMIN->value);
    }
}
