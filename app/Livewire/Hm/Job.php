<?php

namespace App\Livewire\Hm;

use App\Enums\JobSetup;
use App\Enums\JobType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Enums\Layouts;
use App\Models\HiringManager;
use Illuminate\Support\Facades\Auth;

class Job extends Component
{
    #[Layout(Layouts::HM->value)]
    public $hiring_manager;
    public $jobs;
    public function mount()
    {
        $this->hiring_manager = HiringManager::findOrFail(Auth::user()->id);
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

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function render()
    {
        return view('livewire.hm.job');
    }
}
