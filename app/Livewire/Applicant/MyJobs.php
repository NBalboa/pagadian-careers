<?php

namespace App\Livewire\Applicant;

use App\Enums\JobStatus;
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
    public $searchBy;
    public $job_status = null;
    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->total_pending += $this->getJobStatusTotal(JobStatus::PENDING->value);
        $this->total_interview += $this->getJobStatusTotal(JobStatus::INTERVIEW->value);
        $this->total_rejected += $this->getJobStatusTotal(JobStatus::REJECTED->value);
        $this->total_hired += $this->getJobStatusTotal(JobStatus::HIRED->value);
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
    public function render()
    {

        $jobs = $this->applicant->jobs()->with('hiring_manager');

        if (!empty($this->search)) {
            $search = $this->search;
            if ($this->searchBy === 'address') {
                $jobs =
                    $jobs->whereHas('hiring_manager', function ($query) use ($search) {
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
            } else if ($this->searchBy === 'company') {
                $jobs = $jobs->whereHas('hiring_manager', function ($query) use ($search) {
                    $query->whereHas('company', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                });
            } else {
                $jobs = $jobs->where('job_title', 'like', '%' . $search . '%');
            }
        }

        if (!empty($this->job_status)) {
            $status = intval($this->job_status, 10) - 1;
            $jobs = $jobs->wherePivot('status', '=', $status);
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
