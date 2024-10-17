<?php

namespace App\Livewire\Hm;

use App\Enums\JobSetup;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\HiringManager;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PreviewJob extends Component
{

    public Work $job;
    public $address;
    public $company;
    public $hiring_manager;
    public $educations;
    public $skills;
    public $responsibilities;
    public $qualifications;
    public $score;
    public $user;
    public function mount(Work $job)
    {
        $this->job = $job;
        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->get()->first();
        $this->user = Auth::user();
        $this->company = $this->hiring_manager->company()->get()->firstOrFail();
        $this->address = $this->company->address()->get()->firstOrFail();
        $this->educations = $this->job->educations()->get()->toArray();
        $this->skills = $this->job->skills()->get()->toArray();
        $this->responsibilities = $this->job->responsibilities()->get();
        $this->qualifications = $this->job->qualifications()->get();
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

    public function render()
    {
        return view('livewire.hm.preview-job')->layout(Layouts::HM->value);
    }
}
