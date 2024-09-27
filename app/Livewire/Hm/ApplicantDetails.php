<?php

namespace App\Livewire\Hm;

use App\Enums\ApplicantGender;
use App\Enums\JobStatus;
use App\Enums\Layouts;
use App\Models\Work;
use App\Services\JobRecommendationService;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class ApplicantDetails extends Component
{
    public $job;
    public $applicants_w;
    public $statuses = [];
    public $remarks = [];


    public function mount(Work $job)
    {
        $this->job = $job;
        $this->applicants_w = $this->getApplicantScore();
        foreach ($this->applicants_w as $applicant) {
            $this->statuses[$applicant['applicant']->id] = $applicant['applicant']->jobs()->find($job->id)->pivot->status;
            $this->remarks[$applicant['applicant']->id] = "";
        }
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }

    public function applicantJobStatus($id)
    {

        $status = $this->job->applicants()->find($id)->pivot->status;

        return JobStatus::fromValue($status)->stringValue();
    }

    public function getApplicantScore()
    {
        $applicants = $this->job->applicants()->with('user', 'address')->get();
        $jobRecommendation = new JobRecommendationService();


        $result = [];
        foreach ($applicants as $applicant) {
            $score = $jobRecommendation->calculateScore($this->job, $applicant);
            $result[] = [
                'applicant' => $applicant,
                'score' => $score
            ];
        }

        usort($result, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        foreach ($result as $index => $item) {
            $result[$index]['rank'] = $index + 1;
        }

        return $result;
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

    public function save($id)
    {
        $applicant = $this->job->applicants()->find($id);

        $applicant->pivot->status = $this->statuses[$id];
        $applicant->pivot->remarks = $this->remarks[$id];

        $applicant->pivot->save();

        $this->remarks[$id] = "";
        return redirect('/my/job/' . $this->job->id . '/applicants');
    }
    public function render()
    {
        $applicants = $this->paginate($this->applicants_w, 10);
        return view(
            'livewire.hm.applicant-details',
            [
                'applicants' => $applicants
            ]
        )->layout(Layouts::HM->value);
    }
}
