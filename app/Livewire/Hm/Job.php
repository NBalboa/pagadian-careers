<?php

namespace App\Livewire\Hm;

use App\Enums\JobSetup;
use App\Enums\JobType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Enums\Layouts;
use App\Models\HiringManager;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class Job extends Component
{
    #[Layout(Layouts::HM->value)]
    public $hiring_manager;
    public $jobs;
    public $job_type = "";
    public $job_setup = "";
    public $search = "";
    public function mount()
    {

        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();
        $this->jobs = $this->hiring_manager->jobs()->get();
    }

    public function getTotalApplicants($id)
    {
        return $this->jobs->find($id)->applicants()->get()->count();
    }
    public function getJobSetup($value)
    {
        return JobSetup::fromValue($value)->stringValue();
    }

    public function searchJob()
    {
        $this->jobs = $this->hiring_manager->jobs();
        // dd($this->job_setup);
        if (!empty($this->search)) {
            $this->jobs->where('job_title', 'like', '%' . $this->search . '%');
        }

        if ($this->job_setup !== "") {
            $this->jobs->where('job_setup', '=', $this->job_setup);
        }

        if ($this->job_type !== "") {
            $this->jobs->where('job_type', '=', $this->job_type);
        }

        $this->jobs = $this->jobs->get();
    }

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function render()
    {
        return view('livewire.hm.job');
    }
}
