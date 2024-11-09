<?php

namespace App\Livewire\Admin;

use App\Enums\ApplicantGender;
use App\Enums\IsDeletedUser;
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
    public $is_verified;
    public $gender;

    public $MALE = ApplicantGender::MALE->value + 1;
    public $FEMALE = ApplicantGender::FEMALE->value + 1;
    public $NOT_VERIFIED = 0 + 1;
    public $VERIFIED = 1 + 1;
    public function searchJobs()
    {
        $this->resetPage();
    }

    public function getGender($value)
    {
        return ApplicantGender::fromValue($value)->stringValue();
    }

    public function goToApplicantProfile($id)
    {
        return $this->redirect('/applicants/profile/' . $id, navigate: true);
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

        return;
    }

    public function render()
    {

        $applicants = Applicant::with('user', 'address')
            ->whereHas('user', function ($query) {
                $query->where('is_deleted', '=', IsDeletedUser::NO->value);
            });

        if (!empty($this->search)) {
            $search = $this->search;

            $applicants = $applicants->whereHas('user', function ($query) use ($search) {
                $query->whereAny([
                    'first_name',
                    'last_name',
                    'middle_name',
                    'email',
                    'phone_no',
                    'telephone_no',
                    'verifier'
                ], 'like', '%' . $search . '%');
            })
                ->orWhereHas('address', function ($query) use ($search) {
                    $query->whereAny([
                        'street',
                        'barangay',
                        'city',
                        'province'
                    ], 'like', '%' . $search . '%');
                });
        }

        if (!empty($this->gender)) {
            $applicants = $applicants->where('gender', '=', $this->gender - 1);
        }

        if (!empty($this->is_verified)) {
            $applicants = $applicants->where('verified', '=', $this->is_verified - 1);
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
