<?php

namespace App\Livewire\Admin;

use App\Enums\IsDeletedCompany;
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

    public function goToEditCompany($id)
    {
        return redirect('company/edit/' . $id);
    }

    public function searchJobs()
    {
        $this->resetPage();
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        $companies = CompanyModels::with('address')
            ->where('is_deleted', "=", IsDeletedCompany::NO->value);
        if (!empty($this->search)) {

            $search = $this->search;

            $companies = $companies->whereAny(
                [
                    'name',
                    'url'
                ],
                'like',
                '%' . $search . '%'
            )
                ->orWhereHas('address', function ($query) use ($search) {
                    $query->whereAny([
                        'street',
                        'barangay',
                        'city',
                        'province'
                    ], 'like', '%' . $search . '%');
                });
        }

        $companies = $companies->paginate(10);

        return view('livewire.admin.company', [
            'companies' => $companies
        ]);
    }
}
