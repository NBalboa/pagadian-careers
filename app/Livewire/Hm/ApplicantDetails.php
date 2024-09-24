<?php

namespace App\Livewire\Hm;

use App\Enums\ApplicantGender;
use App\Enums\JobStatus;
use App\Enums\Layouts;
use App\Models\Work;
use Livewire\Component;

class ApplicantDetails extends Component
{
    public $job;
    public $applicants;
    public $statuses = [];
    public $remarks = [];


    public function mount(Work $job)
    {
        $this->job = $job;
        $this->applicants = $this->job->applicants()->with('user', 'address')->get();
        foreach ($this->applicants as $applicant) {
            $this->statuses[$applicant->id] = $applicant->jobs()->find($job->id)->pivot->status;
            $this->remarks[$applicant->id] = "";
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
        return view('livewire.hm.applicant-details')->layout(Layouts::HM->value);
    }
}
