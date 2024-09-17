<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.applicant.profile')->layout(Layouts::APPLICANT->value);
    }
}
