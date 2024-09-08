<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\Education;
use App\Models\HiringManager;
use App\Models\Score;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'email' => "nickojek2x@gmail.com",
            'first_name' => "Nicko",
            'last_name' => "Balboa",
            'phone_no' => "09123456789",
            'password' => Hash::make("password"),
            'remember_token' => Str::random(10),
            'role' => 2
        ]);

        Company::create([
            'profile' => "profile/company/sample.jfif",
            'name' => "Balboa Corp.",
            'url' => "link.com",
            'description' => "Amazing Company",
            'address_id' => 2
        ]);

        Address::create([
            'street' => 'street',
            'province' => 'province',
            'city' => 'city',
            'barangay' => 'barangay'
        ]);
        Address::create([
            'street' => 'street',
            'province' => 'province',
            'city' => 'city',
            'barangay' => 'barangay'
        ]);

        HiringManager::create([
            'user_id' => 1,
            'company_id' => 1,
            'address_id' => 1
        ]);



        $score = Score::create([
            'education' => 1,
            'skill' => 2,
            'experience' => 3
        ]);

        $job = Work::create([
            'hiring_manager_id' => 1,
            'job_title' => 'job_tile',
            'job_setup' => 0,
            'job_type' => 0,
            'score_id' => $score->id,
            'description' => 'amazing work place',
            'experience' => 1
        ]);

        $education1 = Education::create([
            'name' => 'Bachelor of Science in Computer Science'
        ]);

        $education2 = Education::create([
            'name' => 'Bachelor of Science in Information Technology'
        ]);

        $skill1 = Skill::create(
            [
                'name' => 'PHP'
            ]
        );
        $skill2 = Skill::create(
            [
                'name' => 'Javascript'
            ]
        );

        $job->responsibilities()->createMany([
            ['description' => 'sadasdas'],
            ['description' => 'sadasdas'],
            ['description' => 'sadasdas']
        ]);

        $job->qualifications()->createMany([
            ['description' => 'qualification sadasdas'],
            ['description' => 'sadasdas'],
            ['description' => 'sadasdas']
        ]);

        $job->educations()->attach([$education1->id, $education2->id]);
        $job->skills()->attach([$skill1->id, $skill2->id]);
    }
}
