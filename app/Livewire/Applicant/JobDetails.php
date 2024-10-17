<?php

namespace App\Livewire\Applicant;

use App\Enums\JobSetup;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Work;
use App\Services\JobRecommendationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JobDetails extends Component
{
    public $job;
    public $address;
    public $company;
    public $hiring_manager;
    public $user;
    public $educations;
    public $skills;
    public $responsibilities;
    public $qualifications;
    public $applicant;
    public $score;
    public function mount(Work $job)
    {
        $this->job = $job;
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->hiring_manager = $job->hiring_manager()->get()->firstOrFail();
        $this->user = $this->hiring_manager->user()->get()->firstOrFail();
        $this->company = $this->hiring_manager->company()->get()->firstOrFail();
        $this->address = $this->company->address()->get()->firstOrFail();
        $this->educations = $this->job->educations()->get()->toArray();
        $this->skills = $this->job->skills()->get()->toArray();
        $this->responsibilities = $this->job->responsibilities()->get();
        $this->qualifications = $this->job->qualifications()->get();
        $this->score = $this->getScore($job);
    }

    public function getScore($job)
    {

        $jobRecommendation = new JobRecommendationService();
        if (
            !$this->applicant->educations()->get()->isEmpty()
            && !$this->applicant->skills()->get()->isEmpty()
            && !$this->applicant->experiences()->get()->isEmpty()
            && $this->applicant->edu_attainment
        ) {
            $score = $jobRecommendation->calculateScore($job, $this->applicant);
            return $score;
        } else {
            return null;
        }
    }

    public function formatDate($date)
    {
        return Carbon::parse($date)->format('F j, Y');
    }

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function getJobSetup($value)
    {
        return JobSetup::fromValue($value)->stringValue();
    }

    public function appliedJob()
    {
        return $this->applicant->jobs()->where('work_id', $this->job->id)->exists();
    }
    public function applyJob($id)
    {
        $this->applicant->jobs()->attach([$id]);
    }
    public function render()
    {
        return view('livewire.applicant.job-details')->layout(Layouts::APPLICANT->value);
    }
}
