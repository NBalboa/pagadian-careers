<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Company;
use App\Models\HiringManager as ModelsHiringManager;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class HiringManager extends Component
{
    use WithPagination;
    public $search;
    public $searchBy;

    public $companies;
    public $company_search;
    public function mount()
    {
        $this->companies = Company::all()->unique('name');
    }


    public function goToEditHiringManager($id)
    {
        return redirect('/hiringmanager/edit/' . $id);
    }

    public function searchJobs()
    {
        $this->resetPage();
    }
    #[Layout('components.admin-layout')]
    public function render()
    {
        $hiring_managers = ModelsHiringManager::with('user', 'company', 'address');



        if (!empty($this->search)) {
            $search = $this->search;


            $hiring_managers = $hiring_managers->whereHas('user', function ($query) use ($search) {
                $query->whereAny([
                    'first_name',
                    'last_name',
                    'middle_name',
                    'email',
                    'phone_no',
                    'telephone_no'
                ], 'like', '%' . $search . '%');
            })->orWhereHas('address', function ($query) use ($search) {
                $query->whereAny([
                    'street',
                    'barangay',
                    'city',
                    'province'
                ], 'like', '%' . $search . '%');
            });
        }

        if (!empty($this->company_search)) {
            $search = $this->company_search;
            $hiring_managers = $hiring_managers->whereHas('company', function ($query) use ($search) {
                $query->where('id', '=',  $search);
            });
        }

        $hiring_managers = $hiring_managers->paginate(10);
        return view('livewire.admin.hiring-manager', [
            'hiring_managers' => $hiring_managers
        ]);
    }
}
