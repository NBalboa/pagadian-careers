<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
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
    public $searchBy = "";
    public function mount()
    {
        $this->applicant =
            Applicant::where('user_id', Auth::user()->id)->firstOrFail();
    }

    public function getRecommendation()
    {
        $jobs = Work::all();
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
    public function search_jobs()
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
        $jobs = Work::with('hiring_manager')->paginate(10);
        if (!empty($this->search)) {
            $search = $this->search;
            $jobs = Work::with("hiring_manager");
            if ($this->searchBy === "Company") {
                $jobs = $jobs->whereHas('hiring_manager', function ($query) use ($search) {
                    $query->whereHas('company', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
                });
            } else if ($this->searchBy === "Address") {
                $jobs =
                    $jobs->whereHas('hiring_manager', function ($query) use ($search) {
                        $query->whereHas('company', function ($query) use ($search) {
                            $query->whereHas('address', function ($query) use ($search) {
                                $query->where(DB::raw("CONCAT(street, ' ', barangay, ' ', city, ' ', province)"), 'like', '%' . $search . '%');
                            });
                        });
                    });
            } else {
                $jobs = $jobs->where('job_title', 'like', '%' . $search . '%');
            }

            $jobs = $jobs->paginate(10);
        }
        if (
            !$this->applicant->educations()->get()->isEmpty()
            && !$this->applicant->skills()->get()->isEmpty()
            && !$this->applicant->experiences()->get()->isEmpty()
            && $this->applicant->edu_attainment
        ) {
            $recommendations = $this->paginate($this->getRecommendation(), 10);
        }


        return view(
            'livewire.applicant.jobs',
            [
                'jobs' => $jobs,
                'recommendations' => $recommendations
            ]
        )->layout(Layouts::APPLICANT->value);
    }
}
