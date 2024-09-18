<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Education;
use App\Rules\ExistEducation;
use App\Rules\NotExistEducation;
use App\Rules\UniqueApplicantEducation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditEducation extends Component
{

    public $list_educations = [];
    // #[Rule(['required', 'string', new ExistEducation(), new UniqueApplicantEducation()])]
    public $input_educations;
    #[Rule('required|string')]
    public $school_name;
    #[Rule('required|numeric')]
    public int $from;
    #[Rule('required|numeric')]
    public int $to;
    public $applicant;
    public $applicant_education;

    public function mount($id)
    {

        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_education = $this->applicant->educations()->findOrFail($id)->toArray();
        $this->school_name = $this->applicant_education['pivot']['school_name'];
        $this->from = $this->applicant_education['pivot']['from'];
        $this->to = $this->applicant_education['pivot']['to'];
        $this->input_educations = $this->applicant_education['name'];
    }


    public function saveChanges()
    {
        $this->validate();


        $this->applicant->educations()->updateExistingPivot($this->applicant_education['id'], [
            'from' => $this->from,
            'to' => $this->to,
            'school_name' => $this->school_name,
        ]);

        return redirect('/my/profile');
    }

    public function saveEducation()
    {
        $this->validate([
            'input_educations' => ['required', new NotExistEducation()]
        ]);

        if (!empty($this->input_skills)) {
            Education::create([
                'name' => $this->input_educations,
            ]);
        }
    }

    public function updatedInputEducations()
    {

        if (!empty($this->input_educations)) {
            $this->list_educations = Education::where('name', 'like', '%' . $this->input_educations . '%')->get();
        } else {

            $this->list_educations = [];
        }
    }
    public function render()
    {
        return view('livewire.applicant.edit-education')->layout(Layouts::APPLICANT->value);
    }
}
