<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use Livewire\Attributes\Layout;
use Livewire\Component;
use  App\Models\Company as CompanyModels;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;

class Company extends Component
{

    use WithPagination;
    public $search;
    public $searchBy;

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
    public function searchJobs()
    {
        $this->resetPage();
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        $companies = CompanyModels::with('address');
        if (!empty($this->search)) {

            $search = $this->search;
            if ($this->searchBy === 'address') {
                $companies = $companies->whereHas('address', function ($query) use ($search) {
                    $query->whereAny([
                        'street',
                        'barangay',
                        'city',
                        'province'
                    ], 'like', '%' . $search . '%');
                });
            } else {

                $companies = $companies->whereAny(
                    [
                        'name',
                        'url'
                    ],
                    'like',
                    '%' . $search . '%'
                );
            }
        }

        $companies = $companies->paginate(10);

        return view('livewire.admin.company', [
            'companies' => $companies
        ]);
    }
}
