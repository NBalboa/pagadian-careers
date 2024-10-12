<?php

namespace App\Livewire\Admin;

use App\Enums\ApplicantGender;
use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Applicants extends Component
{
    use WithPagination;

    public $search;
    public $searchBy;
    public $verified;

    public $show_salary = true;
    public function searchJobs()
    {
        $this->resetPage();
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }

    public function verifyApplicant($id)
    {
        $applicant = Applicant::find($id);
        $verified = $this->verified[$id];
        $applicant->verified = $verified;
        if ($verified === false) {
            $applicant->verifier = '';
        } else {

            $applicant->verifier = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        }
        $applicant->save();
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

        foreach ($applicants as $applicant) {
            $this->verified[$applicant->id] = $applicant->verified === 1 ? true : false;
        }
        return view(
            'livewire.admin.applicants',
            [
                'applicants' => $applicants
            ]

        )->layout(Layouts::ADMIN->value);
    }
}
