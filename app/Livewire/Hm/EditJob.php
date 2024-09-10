<?php

namespace App\Livewire\Hm;

use App\Enums\Layouts;
use App\Models\Education;
use App\Models\HiringManager;
use App\Models\Qualification;
use App\Models\Responsibility;
use App\Models\Skill;
use App\Models\Work;
use App\Rules\ExistEducation;
use App\Rules\ExistSkill;
use App\Rules\NotExistEducation;
use App\Rules\NotExistSkill;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditJob extends Component
{

    public $input_skills = "";
    public $input_educations = "";
    public $reponsibility;
    public $qualification;

    public Work $job;
    public HiringManager $hiring_manager;
    #[Rule('required|string')]
    public string $job_title;
    public $qualifications;
    public $responsibilities;
    public $job_educations;
    public $job_skills;
    #[Rule('required|string')]
    public $description;
    #[Rule('required')]
    public int $job_setup;
    #[Rule('required')]
    public int $job_type;
    public $salary;
    public $show_salary;
    #[Rule('required')]
    public int $experience;
    public $list_educations = [];
    public $list_skills = [];


    public $previousQualification;
    public $previousResponsibility;


    #[Rule('required')]
    public int $skill_score;
    #[Rule('required')]
    public int $education_score;
    #[Rule('required')]
    public int $experience_score;
    #[Rule('required|in:10')]
    public int $total_score;


    public $score;

    public function mount(HiringManager $hiring_manager, Work $job)
    {
        $this->hiring_manager = $hiring_manager;
        $this->job = $this->hiring_manager->jobs()->where('id', $job->id)->firstOrFail();
        $this->job_title = $this->job->job_title;
        $this->description = $this->job->description;
        $this->job_setup = $this->job->job_setup;
        $this->job_type  = $this->job->job_type;
        $this->salary = $this->job->salary;
        $this->experience = $this->job->experience;
        $this->show_salary = ($this->job->show_salary === 0 ? false : true);
        $this->qualifications = $this->job->qualifications()->get()->toArray();
        $this->responsibilities = $this->job->responsibilities()->get()->toArray();
        $this->job_educations = $this->job->educations()->get();
        $this->job_skills = $this->job->skills()->get();

        $this->previousQualification = $this->qualifications;
        $this->previousResponsibility = $this->responsibilities;

        $this->score = $this->job->score()->firstOrFail();

        $this->education_score = $this->score->education;
        $this->skill_score = $this->score->skill;
        $this->experience_score = $this->score->experience;
    }


    public function save()
    {

        $this->total_score
            = $this->experience_score + $this->education_score + $this->skill_score;

        $this->validate();

        $score = $this->score->fill([
            'experience' => $this->experience_score,
            'education' => $this->education_score,
            'skill' => $this->skill_score
        ]);

        $job = $this->job->fill([
            'job_title' => $this->job_title,
            'job_setup' => $this->job_setup,
            'job_type' => $this->job_type,
            'description' => $this->description,
            'salary' => $this->salary,
            'experience' => $this->experience,
            'show_salary' => ($this->show_salary ? 1 : 0)
        ]);

        $score_changes = $score->getDirty();
        $job_changes = $job->getDirty();

        if ($score_changes && $job_changes) {

            $this->job->update($job_changes);
            $this->score->update($score_changes);

            return redirect('job/edit/' . $this->hiring_manager->id . '/' . $this->job->id)
                ->with(['success' => 'Successfully save Job details and Score details changes']);
        }
        if ($score_changes) {

            $this->score->update($score_changes);
            return redirect('job/edit/' . $this->hiring_manager->id . '/' . $this->job->id)
                ->with(['success' => 'Successfully Score details changes']);
        }
        if ($job_changes) {

            $this->job->update($job_changes);
            return redirect('job/edit/' . $this->hiring_manager->id . '/' . $this->job->id)
                ->with(['success' => 'Successfully save Job details changes']);
        }
    }

    public function addJobQualification()
    {

        $this->validate([
            'qualification' => ['required']
        ]);

        $this->job->qualifications()->create(['description' => $this->qualification]);
        $this->qualifications = $this->job->qualifications()->get()->toArray();
        $this->previousQualification = $this->qualifications;

        $this->qualification = '';
    }


    function saveEducation()
    {

        $this->validate([
            'input_educations' => ['required', new NotExistEducation()]
        ]);

        if (!empty($this->input_educations)) {
            Education::create([
                'name' => $this->input_educations,
            ]);
        }

        $this->input_educations = '';
    }

    public function removeJobEducation($value)
    {
        if ($this->job->educations()->count() > 1) {
            $this->job->educations()->detach([$value]);
            $this->job_educations = $this->job->educations()->get();
        }
    }

    public function addJobEducation()
    {
        $this->validate([
            'input_educations' => ['required', new ExistEducation()]
        ]);

        $education = Education::where('name', 'like', $this->input_educations)->first();

        if ($education) {
            $this->job->educations()->create(['id' => $education->id, 'name' => $education->name]);
            $this->job_educations = $this->job->educations()->get();
        }

        $this->input_educations = "";
    }

    public function removeJobSkill($value)
    {
        if ($this->job->skills()->count() > 1) {

            $this->job->skills()->detach([$value]);
            $this->job_skills = $this->job->skills()->get();
        }
    }

    function saveSkill()
    {

        $this->validate([
            'input_skills' => ['required', new NotExistSkill()]
        ]);

        if (!empty($this->input_skills)) {
            Skill::create([
                'name' => $this->input_skills,
            ]);
        }

        $this->input_skills = "";
    }

    public function addJobSkill()
    {
        $this->validate([
            'input_skills' => ['required', new ExistSkill()]
        ]);

        $skill = Skill::where('name', 'like', $this->input_skills)->first();
        if ($skill) {
            $this->job->skills()->create(['id' => $skill->id, 'name' => $skill->name]);
            $this->job_skills = $this->job->skills()->get();
        }

        $this->input_skills = "";
    }

    public function removeQualification($index)
    {
        if (count($this->qualifications) > 1) {
            $qualifications = Qualification::findOrFail($this->qualifications[$index]['id']);
            $qualifications->delete();
            $this->qualifications = $this->job->qualifications()->get()->toArray();
            $this->previousResponsibility = $this->qualifications;
        }
    }

    public function saveEditedQualification($index)
    {
        $isSame = ($this->qualifications[$index]['description'] === $this->previousQualification[$index]['description'] ? true : false);


        if (empty($this->qualifications[$index]['description']) || $isSame) {
            $this->qualifications[$index]['description'] = $this->previousQualification[$index]['description'];
        } else {

            Qualification::where('id', $this->qualifications[$index]['id'])->update([
                'description' => $this->qualifications[$index]['description']
            ]);
            $this->previousQualification = $this->qualifications;
        }
    }

    public function addJobResponsibility()
    {
        $this->validate([
            'reponsibility' => ['required']
        ]);

        $this->job->responsibilities()->create([
            'description' => $this->reponsibility
        ]);

        $this->responsibilities = $this->job->responsibilities()->get()->toArray();
        $this->previousResponsibility = $this->responsibilities;

        $this->reponsibility = '';
    }

    public function removeResponsibilities($index)
    {
        if (count($this->responsibilities) > 1) {
            $responsibility = Responsibility::findOrFail($this->responsibilities[$index]['id']);
            $responsibility->delete();
            $this->responsibilities = $this->job->responsibilities()->get()->toArray();
            $this->previousResponsibility = $this->responsibilities;
        }
    }
    public function saveEditedResponsibilities($index)
    {
        $isSame = ($this->responsibilities[$index]['description'] === $this->previousResponsibility[$index]['description'] ? true : false);


        if (empty($this->responsibilities[$index]['description']) || $isSame) {
            $this->responsibilities[$index]['description'] = $this->previousResponsibility[$index]['description'];
        } else {

            Responsibility::where('id', $this->responsibilities[$index]['id'])->update([
                'description' => $this->responsibilities[$index]['description']
            ]);
            $this->previousResponsibility = $this->responsibilities;
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

    public function updatedInputSkills()
    {

        if (!empty($this->input_skills)) {
            $this->list_skills = Skill::where('name', 'like', '%' . $this->input_skills . '%')->get();
        } else {
            $this->list_skills = [];
        }
    }
    public function render()
    {
        return view('livewire.hm.edit-job')->layout(Layouts::HM->value);
    }
}
