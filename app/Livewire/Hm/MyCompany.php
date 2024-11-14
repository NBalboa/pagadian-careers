<?php

namespace App\Livewire\Hm;

use App\Enums\Layouts;
use App\Models\Address;
use App\Models\Company;
use App\Models\HiringManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyCompany extends Component
{
    use WithFileUploads;
    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];
    public HiringManager $hiring_manager;
    public Company $company;

    #[Rule('required')]
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
    public $company_profile;
    public function mount()
    {
        $this->hiring_manager = HiringManager::where('user_id', Auth::user()->id)->first();
        $this->company = $this->hiring_manager->company()->get()->first();

        $this->name = $this->company->name;
        $this->url = $this->company->url;
        $this->description = $this->company->description;
        $this->company_profile = $this->company->profile;
    }

    function changeLogo()
    {
        $validated = $this->validate(['profile' => 'required|image']);

        if ($this->profile) {
            $validated['profile'] =
                $this->profile->store('profile/company', 'public');
        }

        if (Storage::disk("public")->exists($this->company->profile)) {
            Storage::disk('public')->delete($this->company->profile);
        }
        $this->company->update(['profile' => $validated['profile']]);

        redirect("/my/company")->with(['success' => 'Logo updated successfully']);
    }

    function changeCompanyDetails()
    {
        $this->validate(
            [
                'name' => 'required|string',
                'description' => 'required|string'
            ]
        );

        $this->company->fill([
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description
        ]);

        $changes = $this->company->getDirty();

        if ($changes) {
            $this->company->update($changes);

            redirect("/my/company")->with(['success' => 'Company details updated successfully']);
        }
    }

    public function changeAddress()
    {
        $this->validate(
            [
                'street' => 'required|string',
                'barangay' => 'required|string',
                'city' => 'required|string',
                'province' => 'required|string'
            ]
        );

        $address = Address::findOrFail($this->company->address_id);

        $address->fill(
            [
                'street' => $this->street,
                'barangay' => $this->barangay,
                'city' => $this->city,
                'province' => $this->province
            ]
        );

        $changes = $address->getDirty();

        if ($changes) {
            $address->update($changes);

            redirect("/my/company")->with(['success' => 'Address updated successfully']);
        }
    }

    public function render()
    {
        return view('livewire.hm.my-company')->layout(Layouts::HM->value);
    }
}
