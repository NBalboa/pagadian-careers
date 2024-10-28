<?php

namespace App\Livewire;

use App\Enums\IsDeletedCompany;
use App\Enums\IsDeletedJob;
use App\Enums\IsDeletedUser;
use App\Enums\IsJobClose;
use App\Enums\JobSetup;
use App\Enums\JobType;
use App\Enums\Layouts;
use App\Models\Company;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Livewire\Component;
use Livewire\WithPagination;

class Welcome extends Component
{
    use WithPagination;

    public $filters = [
        'recent' => [
            'is_active' => true,
            'job_type' => null,
        ],
        'permanent' => [
            'is_active' => false,
            'job_type' => JobType::PERMANENT->value + 1,
        ],
        'part-time' => [
            'is_active' => false,
            'job_type' => JobType::PART_TIME->value + 1,
        ],
        'full-time' => [
            'is_active' => false,
            'job_type' => JobType::FULL_TIME->value + 1,
        ],
        'contractual' => [
            'is_active' => false,
            'job_type' => JobType::CONTRACTUAL->value + 1,
        ]
    ];

    public $filter_job_type = null;
    public $companies;
    public $search_company = null;

    public $showdropDown = false;
    public $search = "";

    public $FAQs = [
        [
            'id' => 1,
            'title' => "What is pagadian careers?",
            'content' => "This is the content",
            'show' => false
        ],
        [
            'id' => 2,
            'title' => "How to post a job?",
            'content' => "This is the content",
            'show' => false
        ],
        [
            'id' => 3,
            'title' => "How to verify account?",
            'content' => "This is the content",
            'show' => false
        ],
    ];


    public function mount()
    {
        $this->companies =
            Company::where('is_deleted', "=", IsDeletedCompany::NO->value)->get();
    }
    public function setShowDropDown()
    {
        $this->showdropDown = !$this->showdropDown;
    }

    public function showAccordion($index)
    {
        $this->FAQs[$index]['show'] = !$this->FAQs[$index]['show'];
    }

    public function setSearchCompany($id)
    {
        $this->search_company =
            Company::where('is_deleted', "=", IsDeletedCompany::NO->value)
            ->where('id', $id)
            ->get()->first();
        $this->showdropDown = false;
        $this->resetPage();
    }

    public function setSearch()
    {
        $this->resetPage();
    }


    public function changeChangeFilter($filter_name)
    {

        $last_state = $this->filters[$filter_name]['is_active'];

        if (!$last_state) {
            foreach ($this->filters as $index => $filter) {
                if ($index === $filter_name) {
                    $this->filters[$index]['is_active'] = true;
                    $this->filter_job_type = $this->filters[$index]['job_type'];
                } else {
                    $this->filters[$index]['is_active'] = false;
                }
            }
            return $this->resetPage();
        }
    }
    public function getJobType($value)
    {
        return JobType::fromValue($value)->stringValue();
    }
    public function getJobSetup($value)
    {
        return JobSetup::fromValue($value)->stringValue();
    }
    public function formatDate($date)
    {
        return Carbon::parse($date)->format('F j, Y');
    }

    public function render()
    {
        $jobs = Work::with('hiring_manager')
            ->where('is_closed', '=', IsJobClose::NO)
            ->whereColumn('max_applicants_hired', '>', 'hired_no')
            ->whereDate('start_hiring', '<=', Date::now())
            ->whereDate('end_hiring', '>=', 'start_hiring')
            ->where('is_deleted', '=', IsDeletedJob::NO->value)
            ->whereHas('hiring_manager', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('is_deleted', '=', IsDeletedUser::NO->value);
                });
                $query->whereHas('company', function ($query) {
                    $query->where('is_deleted', '=', IsDeletedCompany::NO->value);
                });
            });

        if ($this->search) {
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

        if ($this->search_company) {
            $company_search = $this->search_company->id;
            $jobs = $jobs->whereHas('hiring_manager', function ($query) use ($company_search) {
                $query = $query->whereHas('company', function ($query) use ($company_search) {
                    $query = $query->where('id', '=', $company_search);
                });
            });
        }

        if ($this->filter_job_type) {
            $jobs = $jobs->where('job_type', '=', $this->filter_job_type - 1);
        } else {
            $jobs = $jobs->latest();
        }

        $jobs = $jobs->limit(5)->get();

        return view(
            'livewire.welcome',
            [
                'jobs' => $jobs
            ]
        )->layout(Layouts::APPLICANT->value);
    }
}
