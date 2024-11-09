<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreateCompany extends Component
{

    use WithFileUploads;

    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];


    #[Rule('required|image')]
    public $profile;
    #[Rule('required|string')]
    public $name;
    public $url;
    #[Rule('required|string')]
    public $description;

    #[Rule('required|string')]
    public $street;
    #[Rule('required|string')]
    public $province;
    #[Rule('required|string')]
    public $city;
    #[Rule('required|string')]
    public $barangay;

    public function save()
    {
        $validated = $this->validate();


        DB::beginTransaction();
        try {


            if ($this->profile) {
                $validated['profile'] = $this->profile->store('profile/company', 'public');
            }
            $address = Address::create([
                'street' => $this->street,
                'province' => $this->province,
                'city' => $this->city,
                'barangay' => $this->barangay
            ]);

            Company::create([
                'profile' => $validated['profile'],
                'name' => $this->name,
                'url' => $this->url,
                'description' => $this->description,
                'address_id' => $address->id
            ]);

            DB::commit();

            return redirect('/company')->with(['success' => 'Company created successfully']);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
            if (Storage::disk("public")->exists($validated['profile'])) {
                Storage::disk('public')->delete($validated['profile']);
            }
            Log::error('Error creating Company: ' . $e->getMessage());
            DB::rollBack();
        }
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.create-company');
    }
}
