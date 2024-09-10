<?php

namespace App\Livewire\Hm;

use App\Enums\Layouts;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.hm.dashboard')->layout(Layouts::HM->value);
    }
}
