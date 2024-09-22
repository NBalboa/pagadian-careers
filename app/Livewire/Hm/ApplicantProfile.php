<?php

namespace App\Livewire\Hm;

use App\Enums\ApplicantGender;
use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Work;
use Livewire\Component;

class ApplicantProfile extends Component
{
    public $applicant;
    public $address;
    public $applicant_educations;
    public $applicant_experiences;
    public $applicant_skills;
    public $job;
    public function mount(Work $job, Applicant $applicant)
    {
        $this->job = $job;
        $this->applicant = $applicant;
        $this->address = $applicant->address()->get()->first();
        $this->applicant_educations = $applicant->educations()->get()->toArray();
        $this->applicant_experiences = $applicant->experiences()->get();
        $this->applicant_skills = $applicant->skills()->get()->toArray();
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }
    public function render()
    {
        return view('livewire.hm.applicant-profile')->layout(Layouts::HM->value);
    }
}
