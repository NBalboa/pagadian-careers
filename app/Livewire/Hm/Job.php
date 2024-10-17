<?php

namespace App\Livewire\Hm;

use App\Enums\IsJobClose;
use App\Enums\JobSetup;
use App\Enums\JobType;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Enums\Layouts;
use App\Models\HiringManager;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Job extends Component
{

    use WithPagination;

    #[Layout(Layouts::HM->value)]
    public $job_type;
    public $job_setup;
    public $search;

    public $JOB_PERMANENT = JobType::PERMANENT->value + 1;
    public $JOB_PART_TIME = JobType::PART_TIME->value + 1;
    public $JOB_FULL_TIME = JobType::FULL_TIME->value + 1;
    public $JOB_CONTRACTUAL = JobType::CONTRACTUAL->value + 1;

    public $JOB_ON_SITE = JobSetup::ON_SITE->value + 1;
    public $JOB_REMOTE = JobSetup::REMOTE->value + 1;
    public $JOB_HYBRID = JobSetup::HYBRID->value + 1;

    public $JobIsClosedIds = [];

    public function getTotalApplicants($job)
    {
        return $job->applicants()->get()->count();
    }

    public function isCloseJob($id)
    {
        $job = Work::find($id);
        $is_close = $this->JobIsClosedIds[$id];
        $job->is_closed = $is_close;
        $job->save();
    }

    public  function isClosed($job)
    {
        $this->JobIsClosedIds[$job->id] = $job->is_closed === IsJobClose::YES->value ? true : false;
    }
    public function getJobSetup($value)
    {
        return JobSetup::fromValue($value)->stringValue();
    }

    public function searchJob()
    {
        $this->resetPage();
    }

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function render()
    {
        $hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();

        $jobs = $hiring_manager->jobs();
        // dd($this->job_setup);
        if (!empty($this->search)) {
            $jobs = $jobs->whereAny(
                [
                    'job_title',
                    'salary'
                ],
                'like',
                '%' . $this->search . '%'
            );
        }

        if (!empty($this->job_setup)) {
            $jobs = $jobs->where('job_setup', '=', $this->job_setup - 1);
        }

        if (!empty($this->job_type)) {
            $jobs = $jobs->where('job_type', '=', $this->job_type - 1);
        }

        $jobs = $jobs->paginate(10);

        foreach ($jobs as $job) {
            $this->isClosed($job);
        }

        return view(
            'livewire.hm.job',
            [
                'jobs' => $jobs
            ]
        );
    }
}
