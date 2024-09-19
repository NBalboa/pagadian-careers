<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditExperience extends Component
{
    public $applicant;
    public $applicant_experience;

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


    public function mount($id)
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_experience = $this->applicant->experiences()->where('id', $id)->firstOrFail();
        $this->title = $this->applicant_experience->title;
        $this->company_name = $this->applicant_experience->company_name;
        $this->description = $this->applicant_experience->description;
        $this->start = $this->applicant_experience->start;
        $this->end = $this->applicant_experience->end;
    }
    public function saveChangesExperience()
    {

        $experience = $this->applicant_experience->fill([
            'title' => $this->title,
            'company_name' => $this->company_name,
            'description' => $this->description,
            'start' => $this->start,
            'end' => $this->end
        ]);

        $changes = $experience->getDirty();

        if ($changes) {
            $this->applicant_experience->update($changes);

            return redirect('/my/profile');
        };
    }
    public function render()
    {
        return view('livewire.applicant.edit-experience')->layout(Layouts::APPLICANT->value);
    }
}
