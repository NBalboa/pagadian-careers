<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Company;
use Livewire\Attributes\Layout;
use App\Models\HiringManager as ModelsHirinManager;
use App\Models\User;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditHiringManager extends Component
{
    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];

    public $hiring_manager;
    public $companies;

    public $telephone_no;
    public $middle_name;


    #[Rule('required|string')]
    public $first_name;
    #[Rule('required|string')]
    public $last_name;
    #[Rule('required|string')]
    public $phone_no;
    #[Rule('required|')]
    public $company;
    #[Rule('required|email')]
    public $email;

    #[Rule('required|string')]
    public $street;
    #[Rule('required|string')]
    public $province;
    #[Rule('required|string')]
    public $city;
    #[Rule('required|string')]
    public $barangay;

    public function mount($id)
    {
        $this->hiring_manager = ModelsHirinManager::with('user', 'company')->findOrFail($id);
        $this->companies = Company::where('id', '!=', $this->hiring_manager->company_id)->get();
        $this->first_name = $this->hiring_manager->user->first_name;
        $this->last_name = $this->hiring_manager->user->last_name;
        $this->middle_name = $this->hiring_manager->user->middle_name;
        $this->phone_no = $this->hiring_manager->user->phone_no;
        $this->telephone_no = $this->hiring_manager->user->telephone_no;
        $this->email = $this->hiring_manager->user->email;
        $this->company = $this->hiring_manager->company_id;
    }
    public function delete($id)
    {
        $hiring_manager = HiringManager::with('user')->findOrFail($id);
        $user = User::findOrFail($hiring_manager->user->id);
        $address = Address::findOrFail($hiring_manager->address_id);
        $hiring_manager->delete();
        $user->delete();
        $address->delete();

        redirect('hiringmanager')->with(['success' => 'Hiring Manager deleted successfully']);
    }

    public function save()
    {
        $this->validate();

        $user = User::findOrFail($this->hiring_manager->user->id);
        $user->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'phone_no' => $this->phone_no,
            'telephone_no' => $this->telephone_no
        ]);
        $changes = $user->getDirty();

        if ($changes) {
            $user->update($changes);

            $this->hiring_manager->update(['company_id' => $this->company]);

            redirect('hiringmanager/edit/' . $this->hiring_manager->id)->with(['success' => 'Hiring Manager edited successfully']);
        }
    }

    public function changeAddress()
    {
        $this->validate();


        $address = Address::findOrFail($this->hiring_manager->address_id);

        $address->update([
            'street' => $this->street,
            'province' => $this->province,
            'city' => $this->city,
            'barangay' => $this->barangay
        ]);

        redirect('hiringmanager/edit/' . $this->hiring_manager->id)->with(['success' => 'Hiring Manager edited successfully']);
    }

    public function changeEmail()
    {
        $this->validate(['email' => 'unique:users']);

        $user = User::findOrFail($this->hiring_manager->user->id);

        $user->update([
            'email' => $this->email
        ]);

        redirect('hiringmanager/edit/' . $this->hiring_manager->id)->with(['success' => 'Successfully change email']);
    }

    public function changePhone()
    {
        $this->validate(['phone_no' => 'unique:users']);
        $user = User::findOrFail($this->hiring_manager->user->id);

        $user->update([
            'phone_no' => $this->phone_no
        ]);

        redirect('hiringmanager/edit/' . $this->hiring_manager->id)->with(['success' => 'Successfully change email']);
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.edit-hiring-manager');
    }
}
