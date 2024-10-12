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

        $barangays = [
            'San Lorenzo',
            'La Paz',
            'Bahay Toro',
            'Bagong Pag-asa',
            'Malibay',
            'Old Balara',
            'Bel-Air',
            'Poblacion',
            'Quezon City',
            'Fort Bonifacio',
            'Malate',
            'Pasay'
        ];

        $cities = [
            'Quezon City',
            'Makati',
            'Manila',
            'Cebu City',
            'Davao City',
            'Bacolod',
            'Zamboanga',
            'Pasig',
            'Taguig',
            'Iloilo City',
            'Antipolo',
            'Cagayan de Oro'
        ];

        $provinces = [
            'Metro Manila',
            'Cebu',
            'Davao del Sur',
            'Negros Occidental',
            'Pangasinan',
            'Batangas',
            'Laguna',
            'Bulacan',
            'Rizal',
            'Quezon',
            'Cavite',
            'Iloilo'
        ];

        // create applicant
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone_no' => "09" . $faker->unique()->numberBetween(10000000, 99999999),
                'password' => Hash::make("password"),
                'remember_token' => Str::random(10),
                'role' => UserRole::APPLICANTS->value
            ]);

            $address = Address::create([
                'street' => $faker->streetAddress,
                'barangay' => "Barangay" . $faker->randomElement($barangays),
                'city' => $faker->randomElement($cities),
                "province" => $faker->randomElement($provinces)
            ]);

            Applicant::create([
                'user_id' => $user->id,
                'address_id' => $address->id,
                'profile' => 'profile/user/male.jpg',
                'gender' => ApplicantGender::MALE->value,
                'about' => ""
            ]);
        }
        // create hms
        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'email' => $faker->unique()->safeEmail,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone_no' => "09" . $faker->unique()->numberBetween(10000000, 99999999),
                'password' => Hash::make("password"),
                'remember_token' => Str::random(10),
                'role' => UserRole::HIRING_MANAGER->value
            ]);

            $address_company = Address::create([
                'street' => $faker->streetAddress,
                'barangay' => "Barangay " . $faker->randomElement($barangays),
                'city' => $faker->randomElement($cities),
                "province" => $faker->randomElement($provinces)
            ]);

            $address_hm = Address::create([
                'street' => $faker->streetAddress,
                'barangay' => "Barangay" . $faker->randomElement($barangays),
                'city' => $faker->randomElement($cities),
                "province" => $faker->randomElement($provinces)
            ]);

            $company = Company::create([
                'profile' => "profile/company/baLG7WMPyyfjCe8trSlmW7dJtx15914alUiBZRaJ.png",
                'name' => $faker->company,
                'url' => "link.com",
                'description' =>
                $faker->catchPhrase,
                'address_id' => $address_company->id
            ]);

            HiringManager::create([
                'user_id' => $user->id,
                'company_id' => $company->id,
                'address_id' => $address_hm->id
            ]);
        }


        $jobs = [
            [
                'job_title' => 'IT Support Staff',
                'job_setup' => 0,
                'job_type' => 0,
                'description' => "As an IT Support Staff, you will be responsible for maintaining the company’s IT infrastructure and resolving hardware and software issues.",
                'experience' => 2,
                'qualifications' => [
                    "Degree in Information Technology or related field",
                    "Troubleshooting skills",
                    "Knowledge of basic IT systems"
                ],
                'skills' => [
                    "Problem-solving abilities",
                    "Knowledge of network configurations",
                    "Excellent communication skills"
                ],
                'educations' => [
                    "Bachelor of Science in Information Technology",
                    "Diploma in Network Systems Administration"
                ],
                'responsibilities' => [
                    "Provide technical support to internal teams",
                    "Install, configure, and troubleshoot software and hardware",
                    "Maintain IT documentation and system backups"
                ]
            ],
            [
                'job_title' => 'Data Entry Clerk',
                'job_setup' => 0,
                'job_type' => 1,
                'description' => "The Data Entry Clerk will manage and enter data into the company's systems, ensuring accuracy and confidentiality.",
                'experience' => 0,
                'qualifications' => [
                    "High school diploma or equivalent",
                    "Accurate typing and data entry skills",
                    "Attention to detail"
                ],
                'skills' => [
                    "Fast and accurate typing",
                    "Proficiency with Microsoft Office (Excel, Word)",
                    "Strong organizational skills"
                ],
                'educations' => [
                    "High School Diploma or GED",
                    "Certificate in Office Administration"
                ],
                'responsibilities' => [
                    "Enter and update data into the system accurately",
                    "Verify and correct data discrepancies",
                    "Maintain confidentiality of sensitive information"
                ]
            ],
            [
                'job_title' => 'Inventory Data Entry Specialist',
                'job_setup' => 0,
                'job_type' => 1,
                'description' => "The Inventory Data Entry Specialist ensures all inventory records are accurate and up-to-date, assisting with efficient stock management.",
                'experience' => 1,
                'qualifications' => [
                    "High school diploma or equivalent",
                    "Experience in inventory data entry",
                    "Familiarity with inventory management systems"
                ],
                'skills' => [
                    "Data management and record-keeping",
                    "Attention to detail and accuracy",
                    "Knowledge of inventory software (e.g., SAP, QuickBooks)"
                ],
                'educations' => [
                    "Diploma in Supply Chain Management",
                    "Certificate in Inventory Management"
                ],
                'responsibilities' => [
                    "Accurately input inventory data into systems",
                    "Reconcile inventory records with physical stock",
                    "Assist in inventory audits and report discrepancies"
                ]
            ],
            [
                'job_title' => 'Software Developer',
                'job_setup' => 0,
                'job_type' => 1,
                'description' => "The Software Developer will create, test, and maintain software solutions while collaborating with cross-functional teams.",
                'experience' => 2,
                'qualifications' => [
                    "Bachelor's degree in Computer Science or related field",
                    "2+ years of experience in software development",
                    "Proficiency in programming languages such as Java or Python"
                ],
                'skills' => [
                    "Proficient in version control (Git)",
                    "Problem-solving and analytical skills",
                    "Experience with Agile methodologies"
                ],
                'educations' => [
                    "Bachelor of Science in Computer Science",
                    "Certificate in Full Stack Web Development"
                ],
                'responsibilities' => [
                    "Write clean, maintainable code for software applications",
                    "Collaborate with teams to design and implement new features",
                    "Perform debugging and testing of software components"
                ]
            ],
            [
                'job_title' => 'IT Support Specialist',
                'job_setup' => 0,
                'job_type' => 0,
                'description' => "The IT Support Specialist will provide technical support, troubleshoot issues, and maintain the IT systems.",
                'experience' => 1,
                'qualifications' => [
                    "Associate degree in IT or related field",
                    "1+ years of experience in IT support",
                    "Excellent troubleshooting and communication skills"
                ],
                'skills' => [
                    "Knowledge of hardware troubleshooting",
                    "Understanding of network infrastructure",
                    "Customer service orientation"
                ],
                'educations' => [
                    "Associate Degree in Information Technology",
                    "Certificate in Technical Support"
                ],
                'responsibilities' => [
                    "Diagnose and resolve hardware and software issues",
                    "Support users with technical problems in a timely manner",
                    "Manage and update the company's IT systems and networks"
                ]
            ],
            [
                'job_title' => 'Cybersecurity Analyst',
                'job_setup' => 0,
                'job_type' => 0,
                'description' => "As a Cybersecurity Analyst, you will protect the company’s networks and systems from potential cyber threats and attacks.",
                'experience' => 3,
                'qualifications' => [
                    "Bachelor's degree in Cybersecurity or a related field",
                    "3+ years of experience in cybersecurity",
                    "Certification in CompTIA Security+ or equivalent"
                ],
                'skills' => [
                    "Proficient in threat detection tools",
                    "Knowledge of firewalls and encryption",
                    "Incident response and risk management"
                ],
                'educations' => [
                    "Bachelor of Science in Cybersecurity",
                    "Certification in CompTIA Security+"
                ],
                'responsibilities' => [
                    "Monitor networks for security breaches",
                    "Implement security measures to protect data",
                    "Conduct vulnerability assessments and penetration testing"
                ]
            ],
            [
                'job_title' => 'HR Information Systems (HRIS) Specialist',
                'job_setup' => 1,
                'job_type' => 2,
                'description' => "The HRIS Specialist will assist with the implementation and maintenance of HR systems, ensuring smooth data flow between departments.",
                'experience' => 0,
                'qualifications' => [
                    "Bachelor's degree in HR, Information Systems, or a related field",
                    "Experience in HRIS implementation and management",
                    "Strong analytical and technical skills"
                ],
                'skills' => [
                    "Knowledge of HRIS systems (e.g., Workday, SAP)",
                    "Attention to detail and problem-solving skills",
                    "Proficient in data analysis"
                ],
                'educations' => [
                    "Bachelor's Degree in Human Resource Management",
                    "Certificate in HRIS Implementation"
                ],
                'responsibilities' => [
                    "Assist in the setup and customization of HR systems",
                    "Ensure accurate data entry and system updates",
                    "Troubleshoot HR system issues and provide technical support"
                ]
            ],
            [
                'job_title' => 'Shipping and Receiving Clerk',
                'job_setup' => 0,
                'job_type' => 0,
                'description' => "The Shipping and Receiving Clerk is responsible for managing incoming and outgoing shipments, ensuring accurate documentation and inventory records.",
                'experience' => 1,
                'qualifications' => [
                    "Previous experience in shipping and receiving",
                    "Familiarity with shipping documentation",
                    "Basic computer skills"
                ],
                'skills' => [
                    "Inventory management skills",
                    "Knowledge of shipping software",
                    "Strong organizational skills"
                ],
                'educations' => [
                    "Certificate in Logistics and Supply Chain Management",
                    "Diploma in Warehouse Operations"
                ],
                'responsibilities' => [
                    "Inspect and receive incoming shipments",
                    "Prepare and document outgoing shipments",
                    "Maintain accurate inventory records and reports"
                ]
            ]
        ];
        $hm_ids = HiringManager::pluck('id');
        foreach ($jobs as $index => $job) {
            $score = Score::create([
                'education' => 7,
                'skill' => 3,
                'experience' => 0
            ]);

            $job['score_id'] = $score->id;

            $job['hiring_manager_id'] = $faker->randomElement($hm_ids);

            $job['experience'] = 1;
            $job['edu_attainment'] = EducationAttainment::BachelorDegree->value;

            $skills = $job['skills'];
            $responsibilities = $job['responsibilities'];
            $educations = $job['educations'];
            $qualifications = $job['qualifications'];

            unset($job['skills']);
            unset($job['responsibilities']);
            unset($job['educations']);
            unset($job['qualifications']);
            $job_created = Work::create($job);

            foreach ($skills as $skill) {
                $job_skill = Skill::firstOrCreate(['name' => $skill]);
                $job_created->skills()->attach($job_skill->id);
            }


            foreach ($responsibilities as $responsibility) {
                $job_created->responsibilities()->create(['description' => $responsibility]);
            }

            foreach ($educations as $education) {
                $job_education =
                    Education::firstOrCreate(['name' => $education]);
                $job_created->educations()->attach($job_education->id);
            }


            foreach ($qualifications as $qualification) {
                $job_created->qualifications()->create(['description' => $qualification]);
            }

            $job_created->applicants()->attach(Applicant::pluck('id'));
        }
    }
}
