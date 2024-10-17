<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'hiring_manager_id',
        'job_title',
        'job_setup',
        'job_type',
        'score_id',
        'description',
        'experience',
        'salary',
        'show_salary',
        'edu_attainment',
        'max_applicants_hired',
        'start_hiring',
        'end_hiring',
        'is_closed'
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'work_skill');
    }

    public function educations()
    {
        return $this->belongsToMany(Education::class, 'work_education');
    }

    public function hiring_manager()
    {
        return $this->belongsTo(HiringManager::class, 'hiring_manager_id')->with('user', 'company', 'company.address');
    }


    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'jobs_applicants')
            ->withPivot('status', 'remarks');
    }

    public function score()
    {
        return $this->belongsTo(Score::class, 'score_id');
    }

    public function qualifications()
    {
        return $this->hasMany(Qualification::class);
    }

    public function responsibilities()
    {
        return $this->hasMany(Responsibility::class);
    }
}
