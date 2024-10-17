<?php

namespace App\Livewire\Hm;

use App\Enums\Layouts;
use App\Models\Education;
use App\Models\HiringManager;
use App\Models\Qualification;
use App\Models\Responsibility;
use App\Models\Skill;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public $edu_attainment;


    #[Rule('required')]
    public int $skill_score;
    #[Rule('required')]
    public int $education_score;
    #[Rule('required')]
    public int $experience_score;
    #[Rule('required|in:10')]
    public int $total_score;


    #[Rule('required|numeric|gt:0')]
    public $max_applicants_hired;
    #[Rule('required')]
    public $start_hiring;
    #[Rule('required')]
    public $end_hiring;

    public $score;

    public function mount(Work $job)
    {
        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();
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

        $this->edu_attainment = $this->edu_attainment;
        $this->max_applicants_hired = $this->job->max_applicants_hired;
        $this->start_hiring = $this->job->start_hiring;
        $this->end_hiring = $this->job->end_hiring;
    }


    public function save()
    {
        $this->total_score
            = $this->experience_score + $this->education_score + $this->skill_score;

        $this->validate();
        $start_date = Carbon::parse($this->start_hiring);
        $end_date = Carbon::parse($this->end_hiring);

        if ($start_date->greaterThan($end_date)) {
            $this->addError('start_hiring', 'Hiring Starts must be greater than Hiring Ends');
            return;
        }

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
            'show_salary' => ($this->show_salary ? 1 : 0),
            'max_applicants_hired' => $this->max_applicants_hired,
            'start_hiring' => $start_date,
            'end_hiring' => $end_date,
        ]);

        $score_changes = $score->getDirty();
        $job_changes = $job->getDirty();


        if ($score_changes && $job_changes) {

            $this->job->update($job_changes);
            $this->score->update($score_changes);

            return redirect('/my/job/edit/' . $this->job->id)
                ->with(['success' => 'Successfully save Job details and Score details changes']);
        }
        if ($score_changes) {

            $this->score->update($score_changes);
            return redirect('/my/job/edit/' . $this->job->id)
                ->with(['success' => 'Successfully Score details changes']);
        }
        if ($job_changes) {

            $this->job->update($job_changes);
            return redirect('/my/job/edit/' . $this->job->id)
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
            'input_educations' => ['required']
        ]);

        $education = Education::firstOrCreate([
            'name' => $this->input_educations
        ]);
        $existEdu = $this->job_educations->contains($education->id);

        if ($education && !$existEdu) {
            $this->job->educations()->attach($education->id);
            $this->job_educations = $this->job->educations()->get();
        } else {
            $this->addError('input_educations', 'The education already exist');
            return;
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



    public function addJobSkill()
    {
        $this->validate([
            'input_skills' => ['required']
        ]);

        $skill =
            Skill::firstOrCreate([
                'name' => $this->input_skills
            ]);

        $existSkills = $this->job_skills->contains($skill->id);

        if ($skill && !$existSkills) {
            $this->job->skills()->attach($skill->id);
            $this->job_skills = $this->job->skills()->get();
        } else {
            $this->addError('input_skills', 'The skill already exist');
            return;
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
