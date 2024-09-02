<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Company;
use App\Models\HiringManager;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
    }
}
