<?php

namespace App\Livewire\Applicant;

use App\Enums\ApplicantGender;
use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $applicant;
    public $applicant_educations;
    public function mount()
    {
        $this->applicant = Applicant::with('user')->where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_educations = $this->applicant->educations()->get()->toArray();
    }
    public function removeApplicantEducation($id)
    {
        $this->applicant->educations()->detach([$id]);

        return redirect('/my/profile');
    }
    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }
    public function render()
    {
        return view('livewire.applicant.profile')->layout(Layouts::APPLICANT->value);
    }
}
