<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Work;
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
