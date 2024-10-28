<?php

namespace App\Services;

use App\Models\Applicant;
use App\Models\Work;


class JobRecommendationService
{

    public function calculateScore(Work $job, Applicant $applicant)
    {
        $total_score = 0;

        $scores_rating_from_job = $job->score()->get()->first();
        $job_skill_score = $scores_rating_from_job->skill;
        $job_edu_score = $scores_rating_from_job->education;
        $job_exp_score = $scores_rating_from_job->experience;

        $job_total_score = $job_skill_score + $job_edu_score + $job_exp_score;

        $education_score =
            $this->getEducationScore($job, $applicant);

        $skill_score =
            $this->getSkillScore($job, $applicant);

        $experience_score
            = $this->getExperienceScore($job, $applicant);

        $total_score += $education_score;
        $total_score += $skill_score;
        $total_score += $experience_score;

        $total_score_percent = $job_total_score > 0 ? round(($total_score / $job_total_score) * 100, 2) : 0;
        $education_score_percent = $job_edu_score > 0 ? round(($education_score / $job_edu_score) * 100, 2) : 0;
        $experience_score_percent = $job_exp_score > 0 ? round(($experience_score / $job_exp_score) * 100, 2) : 0;
        $skill_score_percent = $job_skill_score > 0 ? round(($skill_score / $job_skill_score) * 100, 2) : 0;

        return [
            "total" => $total_score_percent,
            'skill' => $skill_score_percent,
            'exp' => $experience_score_percent,
            'edu' => $education_score_percent
        ];
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
