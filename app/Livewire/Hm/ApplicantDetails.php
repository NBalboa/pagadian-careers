<?php

namespace App\Livewire\Hm;

use App\Enums\ApplicantGender;
use App\Enums\IsDeletedUser;
use App\Enums\JobStatus;
use App\Enums\Layouts;
use App\Mail\JobStatusHired;
use App\Mail\JobStatusInterview;
use App\Mail\JobStatusRejected;
use App\Models\Work;
use App\Services\JobRecommendationService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class ApplicantDetails extends Component
{
    use WithPagination;
    public $job;
    public $statuses = [];
    public $prev_statuses = [];
    public $remarks = [];
    public $search;
    public $searchBy;
    public $gender;
    public $job_status;


    public $JOB_PENDING = JobStatus::PENDING->value + 1;
    public $JOB_INTERVIEW = JobStatus::INTERVIEW->value + 1;
    public $JOB_HIRED = JobStatus::HIRED->value + 1;
    public $JOB_REJECTED = JobStatus::REJECTED->value + 1;


    public $MALE = ApplicantGender::MALE->value + 1;
    public $FEMALE = ApplicantGender::FEMALE->value + 1;

    public function mount(Work $job)
    {
        $this->job = $job;
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }


    public function initStatus($applicants)
    {
        foreach ($applicants as $applicant) {
            $this->statuses[$applicant->id] = $applicant->jobs()->find($this->job->id)->pivot->status + 1;
            $this->prev_statuses[$applicant->id] = $applicant->jobs()->find($this->job->id)->pivot->status + 1;
            $this->remarks[$applicant->id] = "";
        }
    }
    public function applicantJobStatus($id)
    {
        $status = $this->job->applicants()->find($id)->pivot->status;

        return JobStatus::fromValue($status)->stringValue();
    }

    public function searchJobs()
    {
        $this->resetPage();
    }

    public function getApplicantScore($applicants)
    {
        // $applicants = $this->job->applicants()->with('user', 'address')->get();
        if (count($applicants) > 0) {
            $this->initStatus($applicants);
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
        } else {
            return [];
        }
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

    public function goToApplicantProfile($job_id, $applicant_id)
    {
        return redirect('/my/job/' . $job_id . '/applicant/profile/' . $applicant_id);
    }

    public function save($id)
    {

        if ($this->prev_statuses[$id] !== $this->statuses[$id]) {
            $applicant = $this->job->applicants()->find($id);
            $status = $this->statuses[$id] - 1;
            $applicant->pivot->status = $status;
            $applicant->pivot->remarks = $this->remarks[$id];

            $applicant->pivot->save();
            $applicant_user = $applicant->user()->get()->first();
            if ($status == JobStatus::INTERVIEW->value) {
                Mail::to($applicant_user->email)
                    ->send(new JobStatusInterview($applicant_user, $this->job));
            } else if ($status == JobStatus::HIRED->value) {
                $hired_no = $this->job->applicants()->wherePivot('status', '=', JobStatus::HIRED->value)->get()->count();
                $this->job->hired_no = $hired_no;
                $this->job->save();
                Mail::to($applicant_user->email)
                    ->send(new JobStatusHired($applicant_user, $this->job));
            } else if ($status == JobStatus::REJECTED->value) {
                $hired_no = $this->job->applicants()->wherePivot('status', '=', JobStatus::HIRED->value)->get()->count();
                $this->job->hired_no = $hired_no;
                $this->job->save();
                Mail::to($applicant_user->email)
                    ->send(new JobStatusRejected($applicant_user, $this->job));
            }
            $this->remarks[$id] = "";
            return redirect('/my/job/' . $this->job->id . '/applicants');
        }
    }


    public function render()
    {
        $applicants = $this->job->applicants()->with('user', 'address')
            ->whereHas('user', function ($query) {
                $query->where('is_deleted', '=', IsDeletedUser::NO->value);
            });

        if (!empty($this->search)) {
            $search = $this->search;

            $applicants = $applicants->whereHas('user', function ($query) use ($search) {
                $query->whereAny([
                    'first_name',
                    'last_name',
                    'middle_name',
                    'email',
                    'phone_no',
                    'telephone_no'
                ], 'like', '%' . $search . '%');
            })->orWhereHas('address', function ($query) use ($search) {
                $query->whereAny([
                    'street',
                    'barangay',
                    'city',
                    'province'
                ], 'like', '%' . $search . '%');
            });
        }

        if (!empty($this->gender)) {
            $applicants = $applicants->where('gender', '=', $this->gender - 1);
        }

        if (!empty($this->job_status)) {
            $applicants = $applicants->wherePivot('status', '=', $this->job_status - 1);
        }

        $applicants = $applicants->get();

        $applicants = $this->paginate($this->getApplicantScore($applicants), 10);
        return view(
            'livewire.hm.applicant-details',
            [
                'applicants' =>  $applicants,

            ]
        )->layout(Layouts::HM->value);
    }
}
