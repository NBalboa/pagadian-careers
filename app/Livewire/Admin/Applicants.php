<?php

namespace App\Livewire\Admin;

use App\Enums\ApplicantGender;
use App\Enums\Layouts;
use App\Models\Applicant;
use Livewire\Component;
use Livewire\WithPagination;

class Applicants extends Component
{
    use WithPagination;

    public $search;
    public $searchBy;

    public function searchJobs()
    {
        $this->resetPage();
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }

    public function render()
    {

        $applicants = Applicant::with('user', 'address');

        if (!empty($this->search)) {
            $search = $this->search;
            if ($this->searchBy === 'address') {
                $applicants = $applicants->whereHas('address', function ($query) use ($search) {
                    $query->whereAny([
                        'street',
                        'barangay',
                        'city',
                        'province'
                    ], 'like', '%' . $search . '%');
                });
            } else {

                $applicants = $applicants->whereHas('user', function ($query) use ($search) {
                    $query->whereAny([
                        'first_name',
                        'last_name',
                        'middle_name',
                        'email',
                        'phone_no',
                        'telephone_no'
                    ], 'like', '%' . $search . '%');
                });
            }
        }


        $applicants = $applicants->paginate(10);

        return view(
            'livewire.admin.applicants',
            [
                'applicants' => $applicants
            ]

        )->layout(Layouts::ADMIN->value);
    }
}
