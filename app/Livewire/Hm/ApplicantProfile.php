<?php

namespace App\Livewire\Hm;

use App\Enums\ApplicantGender;
use App\Enums\EducationAttainment;
use App\Enums\IsVerified;
use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Work;
use App\Services\JobRecommendationService;
use Livewire\Component;

class ApplicantProfile extends Component
{
    public $applicant;
    public $address;
    public $applicant_educations;
    public $applicant_experiences;
    public $applicant_skills;
    public $job;
    public $job_histories;
    public $score;
    public $VERIFIED_YES = IsVerified::YES->value;
    public function mount(Work $job, Applicant $applicant)
    {
        $this->job = $job;
        $this->applicant = $applicant;
        $this->address = $applicant->address()->get()->first();
        $this->applicant_educations = $applicant->educations()->get()->toArray();
        $this->applicant_experiences = $applicant->experiences()->get();
        $this->applicant_skills = $applicant->skills()->get()->toArray();
        $this->job_histories = $applicant->jobs()->with('hiring_manager')->wherePivot('status', '=', JobStatus::HIRED)->get();
        $this->score = $this->getScore();
    }

    public function getScore()
    {
        $jobRecommendation = new JobRecommendationService();

        $score = $jobRecommendation->calculateScore($this->job, $this->applicant);

        return $score;
    }

    public function getEduAttainment($value)
    {
        return EducationAttainment::fromValue($value)->stringValue();
    }


    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
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
