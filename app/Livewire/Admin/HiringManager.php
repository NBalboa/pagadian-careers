<?php

namespace App\Livewire\Admin;

use App\Models\Address;
use App\Models\Company;
use App\Models\HiringManager as ModelsHiringManager;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;



class HiringManager extends Component
{

    public $hiring_managers;



    public function mount()
    {
        $this->hiring_managers = ModelsHiringManager::with('user', 'company', 'address')->get();
    }

    public function delete($id)
    {
        $hiring_manager = ModelsHiringManager::with('user')->findOrFail($id);
        $user = User::findOrFail($hiring_manager->user->id);
        $address = Address::findOrFail($hiring_manager->address_id);
        $hiring_manager->delete();
        $user->delete();
        $address->delete();

        redirect('hiringmanager')->with(['success' => 'Hiring Manager deleted successfully']);
    }


    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.hiring-manager');
    }
}
