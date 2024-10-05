<?php

namespace App\Livewire\Hm;

use App\Enums\Layouts;
use App\Models\Education;
use App\Models\HiringManager;
use App\Models\Score;
use App\Models\Skill;
use App\Models\Work;
use App\Rules\ExistEducation;
use App\Rules\ExistSkill;
use App\Rules\NotExistEducation;
use App\Rules\NotExistSkill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;

class CreateJob extends Component
{
    public $input_skills = "";
    public $input_educations = "";
    // #[Rule('required|min:1')]
    public $list_skills = [];
    // #[Rule('required|min:1')]
    public $list_educations = [];
    #[Rule('required|min:1')]
    public $job_skills = [];
    #[Rule('required|min:1')]
    public $job_educations = [];
    #[Rule('required|min:1')]
    public $responsibilities = [];
    public $reponsibility = '';
    #[Rule('required|min:1')]
    public $qualifications = [];
    public $qualification = '';

    public $show_salary = true;
    #[Rule('required')]
    public string $salary;
    #[Rule('required')]
    public int $experience;
    #[Rule('required')]
    public int $job_type;
    #[Rule('required')]
    public int $job_setup;
    #[Rule('required')]
    public string $description;
    #[Rule('required')]
    public string $job_title;
    #[Rule('required')]
    public int $education_score = 0;
    #[Rule('required')]
    public int $skill_score = 0;
    #[Rule('required')]
    public int $experience_score = 0;
    #[Rule('required|in:10')]
    public int $total_score;

    public $previousValuesQualifcations = [];
    public $previousValuesResponsibilities = [];

    public $hiring_manager;

    public function mount()
    {
        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();
    }

    protected function messages()
    {
        return [
            'total_score.in' => 'The total score must be exactly 10.',
        ];
    }


    public function saveEditedResponsibilities($index)
    {
        if (empty($this->responsibilities[$index]['description'])) {
            $this->responsibilities[$index]['description'] = $this->previousValuesResponsibilities[$index]['description'];
        }
        $this->previousValuesResponsibilities = $this->responsibilities;
    }

    public function saveEditedQualification($index)
    {
        if (empty($this->qualifications[$index]['description'])) {
            $this->qualifications[$index]['description'] = $this->previousValuesQualifcations[$index]['description'];
        }
        $this->previousValuesQualifcations = $this->qualifications;
    }

    public function save()
    {
        $this->total_score
            = $this->experience_score + $this->education_score + $this->skill_score;

        $this->validate();

        DB::beginTransaction();
        try {

            $score =
                Score::create([
                    'education' => $this->education_score,
                    'skill' => $this->skill_score,
                    'experience' => $this->experience_score
                ]);

            $job = Work::create([
                'hiring_manager_id' => $this->hiring_manager->id,
                'job_title' => $this->job_title,
                'job_setup' => $this->job_setup,
                'job_type' => $this->job_type,
                'salary' => $this->salary,
                'score_id' => $score->id,
                'description' => $this->description,
                'experience' => $this->experience,
                'show_salary' => ($this->show_salary ? 1 : 0)
            ]);

            $job->responsibilities()->createMany($this->responsibilities);
            $job->qualifications()->createMany($this->qualifications);

            $education_ids = array_column($this->job_educations, 'id');
            $skills_ids = array_column($this->job_skills, 'id');

            $job->educations()->attach($education_ids);
            $job->skills()->attach($skills_ids);


            DB::commit();
            redirect('/my/job')->with(['success' => 'Job created successfully']);
        } catch (\Exception $e) {
            dd($e);
            Log::error('Error creating Hiring Manager: ' . $e->getMessage());
            DB::rollBack();
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

    function saveEducation()
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

    public function updatedInputSkills()
    {

        if (!empty($this->input_skills)) {
            $this->list_skills = Skill::where('name', 'like', '%' . $this->input_skills . '%')->get();
        } else {
            $this->list_skills = [];
        }
    }


    public function addJobEducation()
    {
        $this->validate([
            'input_educations' => ['required', new ExistEducation()]
        ]);

        $education = Education::where('name', 'like', $this->input_educations)->first();

        if ($education) {
            $this->job_educations[] = ['id' => $education->id, 'name' => $education->name];
        }

        $this->input_educations = "";
    }


    public function removeQualification($value)
    {

        unset($this->qualifications[$value]);
        $this->qualifications = array_values($this->qualifications);
        $this->previousValuesQualifcations = $this->qualifications;
    }

    public function addJobQualification()
    {

        $this->validate([
            'qualification' => ['required']
        ]);

        $this->qualifications[] = ['description' => $this->qualification];
        $this->previousValuesQualifcations = $this->qualifications;

        $this->qualification = '';
    }

    public function removeResponsibility($value)
    {

        unset($this->responsibilities[$value]);
        $this->responsibilities = array_values($this->responsibilities);
        $this->previousValuesResponsibilities = $this->responsibilities;
    }

    public function addJobResponsibility()
    {

        $this->validate([
            'reponsibility' => ['required']
        ]);

        $this->responsibilities[] = ['description' => $this->reponsibility];
        $this->previousValuesResponsibilities = $this->responsibilities;

        $this->reponsibility = '';
    }


    public function addJobSkill()
    {
        $this->validate([
            'input_skills' => ['required', new ExistSkill()]
        ]);

        $skill = Skill::where('name', 'like', $this->input_skills)->first();
        if ($skill) {
            $this->job_skills[] = ['id' => $skill->id, 'name' => $skill->name];
        }

        $this->input_skills = "";
    }
    public function removeJobSkill($id)
    {
        foreach ($this->job_skills as $index => $jobSkill) {
            if ($jobSkill['id'] == $id) {
                unset($this->job_skills[$index]); // Re move the skill by index
                $this->job_skills = array_values($this->job_skills); // Re-index the array
                break;
            }
        }
    }

    public function removeJobEducation($id)
    {
        foreach ($this->job_educations as $index => $jobEducation) {
            if ($jobEducation['id'] == $id) {
                unset($this->job_educations[$index]); // Remove the skill by index
                $this->job_educations = array_values($this->job_educations); // Re-index the array
                break;
            }
        }
    }
    public function render()
    {
        return view(
            'livewire.hm.create-job',
        )
            ->layout(Layouts::HM->value);
    }
}
