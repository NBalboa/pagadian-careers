<?php

namespace App\Livewire\Applicant;

use App\Enums\JobSetup;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Work;
use App\Services\JobRecommendationService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Jobs extends Component
{
    use WithPagination;
    public $applicant;
    public $search = "";
    public $companies;

    public $JOB_PERMANENT = JobType::PERMANENT->value;
    public $JOB_PART_TIME = JobType::PART_TIME->value;
    public $JOB_FULL_TIME = JobType::FULL_TIME->value;
    public $JOB_CONTRACTUAL = JobType::CONTRACTUAL->value;

    public $JOB_ON_SITE = JobSetup::ON_SITE->value;
    public $JOB_REMOTE = JobSetup::REMOTE->value;
    public $JOB_HYBRID = JobSetup::HYBRID->value;

    public $company_search;
    public $job_type;
    public $job_setup;

    public function mount()
    {
        $this->applicant =
            Applicant::where('user_id', Auth::user()->id)->firstOrFail();

        $this->companies = Company::all();
    }

    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function getJobSetup($value)
    {
        return JobSetup::fromValue($value)->stringValue();
    }

    public function getRecommendation($jobs)
    {
        $jobs = $jobs;
        $jobRecommendation = new JobRecommendationService();


        $recommendations = [];
        foreach ($jobs as $job) {
            $score = $jobRecommendation->calculateScore($job, $this->applicant);
            $recommendations[] = [
                'job' => $job,
                'score' => $score
            ];
        }

        usort($recommendations, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return $recommendations;
    }
    public function searchJobs()
    {
        $this->resetPage();
    }
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (LengthAwarePaginator::resolveCurrentPage() ?? 1);
        $items = collect($items); // Convert array to collection

        $currentPageItems = $items->slice(($page - 1) * $perPage, $perPage)->values();
        $paginator =
            new LengthAwarePaginator(
                $currentPageItems,
                $items->count(), // Total number of items
                $perPage,        // Items per page
                $page,           // Current page number
                $options
            );

        $paginator->setPath(url()->current());

        return $paginator;
    }

    public function render()
    {
        $recommendations = [];
        $jobs = Work::with('hiring_manager');
        if (!empty($this->search)) {
            $search = $this->search;
            $jobs =
                $jobs->where('job_title', 'like', '%' . $search . '%')
                ->orWhereHas('hiring_manager', function ($query) use ($search) {
                    $query = $query->whereHas('company', function ($query) use ($search) {
                        $query = $query->whereHas('address', function ($query) use ($search) {
                            $query = $query->whereAny(
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
            $company_search = $this->company_search;
            $jobs = $jobs->whereHas('hiring_manager', function ($query) use ($company_search) {
                $query = $query->whereHas('company', function ($query) use ($company_search) {
                    $query = $query->where('id', '=', $company_search);
                });
            });
        }

        if (!empty($this->job_type)) {
            $jobs = $jobs->where('job_type', '=', $this->job_type - 1);
        }

        if (!empty($this->job_setup)) {
            $jobs = $jobs->where('job_setup', '=', $this->job_setup - 1);
        }

        if (
            !$this->applicant->educations()->get()->isEmpty()
            && !$this->applicant->skills()->get()->isEmpty()
            && !$this->applicant->experiences()->get()->isEmpty()
            && $this->applicant->edu_attainment
        ) {
            $recommendations = $this->paginate($this->getRecommendation($jobs->get()), 10);
        }

        $jobs = $jobs->paginate(10);



        return view(
            'livewire.applicant.jobs',
            [
                'jobs' => $jobs,
                'recommendations' => $recommendations
            ]
        )->layout(Layouts::APPLICANT->value);
    }
}
