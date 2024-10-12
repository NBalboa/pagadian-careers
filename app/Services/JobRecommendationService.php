<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Work;


class JobRecommendationService
{

    public function calculateScore(Work $job, Applicant $applicant)
    {
        $total_score = 0;

        $total_score += $this->getEducationScore($job, $applicant);
        $total_score += $this->getSkillScore($job, $applicant);
        $total_score += $this->getExperienceScore($job, $applicant);
        return round(($total_score / 10) * 100, 2);
    }

    protected function getExperienceScore($job, $applicant)
    {
        $total_experience = $this->getApplicantTotalExperience($applicant);
        if ($total_experience >= $job->experience) {
            return $job->score()->get()->first()->experience;
        } else {
            return 0;
        }
    }

    protected function getEducationScore($job, $applicant)
    {
        $jobEducations = $job->educations()->get()->pluck('name')->toArray();
        $applicantEducations = $applicant->educations()->get()->pluck('name')->toArray();

        $hasMatchingEducation = array_intersect($jobEducations, $applicantEducations);
        $score = $job->score()->get()->first()->education / 2;
        $total_score = 0;
        if ($hasMatchingEducation) {
            $total_score += $score;
        }

        if ($applicant->edu_attainment >= $job->edu_attainment) {
            $total_score += $score;
        }

        return $total_score;
    }

    protected function getSkillScore($job, $applicant)
    {
        $jobSkills = $job->skills()->get()->pluck('name')->toArray();
        $applicantSkills = $applicant->skills()->get()->pluck('name')->toArray();

        $matchingSkills = array_intersect($jobSkills, $applicantSkills);
        $skillMatchPercentage = count($matchingSkills) / count($jobSkills);

        return $skillMatchPercentage * $job->score()->get()->first()->skill;
    }

    protected function getApplicantTotalExperience($applicant)
    {
        $total_experience = 0;
        $experiences = $applicant->experiences()->get();
        foreach ($experiences as $experiences) {
            $total_experience = $experiences->end - $experiences->start;
        }

        return $total_experience;
    }
}
