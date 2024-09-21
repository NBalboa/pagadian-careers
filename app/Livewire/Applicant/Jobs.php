<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Work;
use Livewire\Component;
use Livewire\WithPagination;

class Jobs extends Component
{
    use WithPagination;

    public function render()
    {
        $jobs = Work::with('hiring_manager')->paginate(10);

        return view(
            'livewire.applicant.jobs',
            [
                'jobs' => $jobs
            ]
        )->layout(Layouts::APPLICANT->value);
    }
}
