<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected $table = 'educations';

    public function jobs()
    {
        return $this->belongsToMany(Work::class, 'work_education');
    }

    public function applicants()
    {
        return $this->belongsToMany(Applicant::class, 'applicant_educations');
    }
}
