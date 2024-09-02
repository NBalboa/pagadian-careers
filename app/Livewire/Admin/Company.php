<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use  App\Models\Company as CompanyModels;

class Company extends Component
{

    public $companies;

    public function mount()
    {
        $this->companies = CompanyModels::with('address')->get();
    }

    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.company');
    }
}
