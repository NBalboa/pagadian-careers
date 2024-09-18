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

class CreateEducation extends Component
{
    public $list_educations = [];
    #[Rule(['required', 'string', new UniqueApplicantEducation()])]
    public $input_educations;
    #[Rule('required|string')]
    public $school_name = "";
    #[Rule('required|numeric')]
    public int $from;
    #[Rule('required|numeric')]
    public int $to;
    public $applicant;
    public $applicant_educations;


    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_educations = $this->applicant->educations()->get()->toArray();
    }


    public function updatedInputEducations()
    {

        if (!empty($this->input_educations)) {
            $this->list_educations = Education::where('name', 'like', '%' . $this->input_educations . '%')->get();
        } else {

            $this->list_educations = [];
        }
    }

    public function removeApplicantEducation($id)
    {
        $this->applicant->educations()->detach([$id]);

        return redirect('/my/profile/create/education');
    }


    public function addApplicantEducation()
    {
        $this->validate();

        $education = Education::firstOrCreate([
            'name' => $this->input_educations
        ]);

        $this->applicant->educations()->attach($education->id, [
            'from' => $this->from,
            'to' => $this->to,
            'school_name' => $this->school_name
        ]);

        return redirect('/my/profile/create/education')->with('success', 'Successffully added Education');
    }
    public function render()
    {
        return view('livewire.applicant.create-education')->layout(Layouts::APPLICANT->value);
    }
}
