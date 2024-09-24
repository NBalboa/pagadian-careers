<?php

namespace App\Livewire\Applicant;

use App\Enums\JobStatus;
use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MyJobs extends Component
{
    public $applicant;
    public $jobs;
    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->jobs = $this->applicant->jobs()->with('hiring_manager')->get();
    }

    public function applicantJobStatus($status)
    {

        return JobStatus::fromValue($status)->stringValue();
    }
    public function render()
    {
        return view('livewire.applicant.my-jobs')->layout(Layouts::APPLICANT->value);
    }
}
