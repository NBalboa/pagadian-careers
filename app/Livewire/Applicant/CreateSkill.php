<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Skill;
use App\Rules\UniqueApplicantSkill;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateSkill extends Component
{
    public $list_skills = [];
    #[Rule(['required', 'string', new UniqueApplicantSkill()])]
    public $input_skills = "";
    public $applicant;
    public $applicant_skills;
    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->applicant_skills = $this->applicant->skills()->get()->toArray();
    }

    public function updatedInputSkills()
    {

        if (!empty($this->input_skills)) {
            $this->list_skills = Skill::where('name', 'like', '%' . $this->input_skills . '%')->get();
        } else {
            $this->list_skills = [];
        }
    }
    public function removeApplicantSkill($id)
    {
        $this->applicant->skills()->detach([$id]);
        return redirect('/my/profile/create/skill');
    }
    public function addJobSkill()
    {
        $this->validate();

        $skill = Skill::firstOrCreate([
            'name' => $this->input_skills
        ]);

        $this->applicant->skills()->attach([$skill->id]);

        return redirect('/my/profile/create/skill');
    }
    public function render()
    {
        return view('livewire.applicant.create-skill')->layout(Layouts::APPLICANT->value);
    }
}
