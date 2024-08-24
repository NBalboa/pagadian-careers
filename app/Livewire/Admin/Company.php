<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Company extends Component
{
    #[Layout('components.admin-layout')]
    public function render()
    {
        return view('livewire.admin.company');
    }
}
