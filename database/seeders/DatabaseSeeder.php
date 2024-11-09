<?php

namespace Database\Seeders;

use App\Enums\ApplicantGender;
use App\Enums\EducationAttainment;
use App\Enums\UserRole;
use App\Models\Address;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\Education;
use App\Models\HiringManager;
use App\Models\Score;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Faker\Factory as Faker;
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
        $faker = Faker::create();

        User::create([
            'email' => 'admin@admin.com',
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'phone_no' => "09" . $faker->unique()->numberBetween(10000000, 99999999),
            'password' => Hash::make("password"),
            'remember_token' => Str::random(10),
            'role' => UserRole::ADMIN->value
        ]);
    }
}
