<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use Livewire\Attributes\Layout;
use Livewire\Component;
use  App\Models\Company as CompanyModels;
use Illuminate\Support\Facades\Storage;

class Company extends Component
{

    public $companies;

    public function mount()
    {
        $this->companies = CompanyModels::with('address')->get();
    }

    public function delete($id)
    {
        $company = CompanyModels::with('address')->findOrFail($id);
        $address = Address::findOrFail($company->address_id);
        if (Storage::disk("public")->exists($company['profile'])) {
            Storage::disk('public')->delete($company['profile']);
        }

        $company->delete();
        $address->delete();

        redirect('hiringmanager')->with(['success' => 'Hiring Manager deleted successfully']);
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.company');
    }
}
