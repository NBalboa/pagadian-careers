<?php

namespace App\Livewire\Admin;

use App\Enums\IsDeletedCompany;
use App\Enums\IsDeletedJob;
use App\Enums\IsDeletedUser;
use App\Enums\Layouts;
use App\Models\Applicant;
use App\Models\Company;
use App\Models\HiringManager;
use App\Models\Work;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $total_jobs;
    public $total_applicants;
    public $total_companies;
    public $total_hiring_managers;

    public function mount()
    {
        $this->total_jobs = Work::where('is_deleted', '=', IsDeletedJob::NO->value)
            ->whereHas('hiring_manager', function ($query) {
                $query->whereHas('user', function ($query) {
                    $query->where('is_deleted', '=', IsDeletedUser::NO->value);
                });
                $query->whereHas('company', function ($query) {
                    $query->where('is_deleted', '=', IsDeletedCompany::NO->value);
                });
            })
            ->get()
            ->count();
        $this->total_applicants = Applicant::whereHas('user', function ($query) {
            $query->where('is_deleted', '=', IsDeletedUser::NO->value);
        })
            ->get()
            ->count();
        $this->total_companies = Company::where('is_deleted', "=", IsDeletedCompany::NO->value)
            ->get()
            ->count();
        $this->total_hiring_managers = HiringManager::whereHas('user', function ($query) {
            $query->where('is_deleted', '=', IsDeletedUser::NO->value);
        })
            ->get()
            ->count();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard')->layout(Layouts::ADMIN->value);
    }
}
