<?php

namespace App\Livewire\Applicant;

use App\Enums\JobStatus;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyJobs extends Component
{
    use WithPagination;
    public $applicant;
    public $total_pending = 0;
    public $total_interview = 0;
    public $total_rejected = 0;
    public $total_hired;
    public $search;
    public $job_status = null;
    public $job_histories;
    public $companies;

    public $JOB_PENDING = JobStatus::PENDING->value + 1;
    public $JOB_INTERVIEW = JobStatus::INTERVIEW->value + 1;
    public $JOB_HIRED = JobStatus::HIRED->value + 1;
    public $JOB_REJECTED = JobStatus::REJECTED->value + 1;

    public $company_search;
    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->total_pending += $this->getJobStatusTotal(JobStatus::PENDING->value);
        $this->total_interview += $this->getJobStatusTotal(JobStatus::INTERVIEW->value);
        $this->total_rejected += $this->getJobStatusTotal(JobStatus::REJECTED->value);
        $this->total_hired += $this->getJobStatusTotal(JobStatus::HIRED->value);
        $this->job_histories = $this->applicant->jobs()->with('hiring_manager')->wherePivot('status', '=', JobStatus::HIRED)->get();
        $this->companies = $this->applicant->jobs()
            ->with('hiring_manager.company')
            ->get()
            ->pluck('hiring_manager.company')
            ->unique();
    }
    public function getJobStatus($value)
    {
        return JobStatus::fromValue($value - 1)->stringValue();
    }
    public function getJobStatusTotal($status)
    {
        return $this->applicant->jobs()->wherePivot('status', '=', $status)->count();
    }
    public function searchJobs()
    {
        $this->resetPage();
    }
    public function applicantJobStatus($status)
    {

        return JobStatus::fromValue($status)->stringValue();
    }

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }

    public function render()
    {

        $jobs = $this->applicant->jobs()->with('hiring_manager');

        if (!empty($this->search)) {
            $search = $this->search;
            $jobs = $jobs->where('job_title', 'like', '%' . $search . '%')
                ->orWhereHas('hiring_manager', function ($query) use ($search) {
                    $query->whereHas('company', function ($query) use ($search) {
                        $query->whereHas('address', function ($query) use ($search) {
                            $query->whereAny(
                                [
                                    'street',
                                    'barangay',
                                    'city',
                                    'province'
                                ],
                                'like',
                                '%' . $search . '%'
                            );
                        });
                    });
                });
        }

        if (!empty($this->company_search)) {
            $search = $this->company_search;
            $jobs = $jobs->whereHas('hiring_manager', function ($query) use ($search) {
                $query->whereHas('company', function ($query) use ($search) {
                    $query->where('id', '=', $search);
                });
            });
        }

        if (!empty($this->job_status)) {
            $jobs = $jobs->wherePivot('status', '=', $this->job_status - 1);
        }

        // dd($jobs->paginate(10));
        $jobs = $jobs->paginate(10);
        return view(
            'livewire.applicant.my-jobs',
            [
                'jobs' => $jobs
            ]
        )->layout(Layouts::APPLICANT->value);
    }
}
