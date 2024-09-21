<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Work;
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
    public function mount(Work $job)
    {
        $this->job = $job;
        $this->hiring_manager = $job->hiring_manager()->get()->firstOrFail();
        $this->user = $this->hiring_manager->user()->get()->firstOrFail();
        $this->company = $this->hiring_manager->company()->get()->firstOrFail();
        $this->address = $this->company->address()->get()->firstOrFail();
        $this->educations = $this->job->educations()->get()->toArray();
        $this->skills = $this->job->skills()->get()->toArray();
        $this->responsibilities = $this->job->responsibilities()->get();
        $this->qualifications = $this->job->qualifications()->get();
    }
    public function render()
    {
        return view('livewire.applicant.job-details')->layout(Layouts::APPLICANT->value);
    }
}
