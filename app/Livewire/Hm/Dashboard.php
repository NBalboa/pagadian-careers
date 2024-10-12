<?php

namespace App\Livewire\Hm;

use App\Enums\JobStatus;
use App\Enums\Layouts;
use App\Models\HiringManager;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $total_applicants = 0;
    public $total_jobs = 0;
    public $jobs;
    public $hiring_manager;
    public $total_pending = 0;
    public $total_interview = 0;
    public $total_hired = 0;
    public $total_rejected = 0;
    public function mount()
    {
        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();
        $this->jobs = $this->hiring_manager->jobs()->get();
        $this->total_jobs = $this->jobs->count();

        foreach ($this->jobs as $job) {
            $this->total_applicants += $job->applicants()->count();


            $this->total_pending += $this->countStatus($job, JobStatus::PENDING->value);
            $this->total_interview += $this->countStatus($job, JobStatus::INTERVIEW->value);
            $this->total_hired += $this->countStatus($job, JobStatus::HIRED->value);
            $this->total_rejected += $this->countStatus($job, JobStatus::REJECTED->value);
        }
    }
    public function countStatus($job, $status)
    {
        $total = $job->applicants()->wherePivot('status', '=', $status)->count();

        return $total;
    }
    public function render()
    {
        return view('livewire.hm.dashboard')->layout(Layouts::HM->value);
    }
}
