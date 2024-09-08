<?php

namespace App\Livewire\Hm;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Enums\Layouts;

class Job extends Component
{
    #[Layout(Layouts::HM->value)]


    public function render()
    {
        return view('livewire.hm.job');
    }
}
