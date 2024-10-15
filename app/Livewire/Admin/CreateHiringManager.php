<?php

namespace App\Livewire\Admin;

use App\Mail\HiringManagerCreated;
use App\Models\Address;
use App\Models\Company;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\HiringManager as ModelsHiringManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CreateHiringManager extends Component
{
    public $companies;
    public $telephone_no;
    public $middle_name;

    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];


    #[Rule('required|string')]
    public $first_name;
    #[Rule('required|string')]
    public $last_name;
    #[Rule('required|string|unique:users')]
    public $phone_no;
    #[Rule('required')]
    public $company;
    #[Rule('required|email|unique:users')]
    public $email;

    #[Rule('required|string')]
    public $street;
    #[Rule('required|string')]
    public $province;
    #[Rule('required|string')]
    public $city;
    #[Rule('required|string')]
    public $barangay;

    public function mount()
    {
        $this->companies = Company::all();
    }

    public function save()
    {


        $this->validate();

        $randomPassword = Str::random(12);

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $this->email,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'phone_no' => $this->phone_no,
                'telephone_no' => $this->telephone_no,
                'password' => Hash::make($randomPassword),
                'remember_token' => Str::random(10),
                'role' => 2
            ]);

            $address = Address::create([
                'street' => $this->street,
                'province' => $this->province,
                'city' => $this->city,
                'barangay' => $this->barangay
            ]);

            ModelsHiringManager::create([
                'user_id' => $user->id,
                'company_id' => $this->company,
                'address_id' => $address->id
            ]);

            DB::commit();

            Mail::to($user->email)->send(new HiringManagerCreated($user, $randomPassword));

            redirect('hiringmanager')->with(['success' => 'Hiring Manager created successfully']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Hiring Manager');
            Log::error('Error creating Hiring Manager: ' . $e->getMessage());
            DB::rollBack();
        }
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.create-hiring-manager');
    }
}
