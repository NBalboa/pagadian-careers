<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateExperience extends Component
{

    public $applicant;
    public $applicant_experiences;

    #[Rule('required|string')]
    public $title;
    #[Rule('required|string')]
    public $company_name;
    #[Rule('required|string')]
    public $description;
    #[Rule('required|numeric')]
    public $start;
    #[Rule('required|numeric')]
    public $end;


    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_experiences = $this->applicant->experiences()->get();
    }

    public function addApplicantExperience()
    {
        $this->validate();
        $this->applicant->experiences()->create(
            [
                'title' => $this->title,
                'company_name' => $this->company_name,
                'description' => $this->description,
                'start' => $this->start,
                'end' => $this->end,
            ]
        );

        return redirect('/my/profile/create/experience');
    }

    public function delete($id)
    {
        $experience = $this->applicant->experiences()->where('id', $id)->firstOrFail();
        $experience->delete();
        return redirect('/my/profile/create/experience');
    }

    public function render()
    {
        return view('livewire.applicant.create-experience')->layout(Layouts::APPLICANT->value);
    }
}
