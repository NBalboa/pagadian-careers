<?php

namespace App\Livewire\Admin;

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
        $this->total_jobs = Work::all()->count();
        $this->total_applicants = Applicant::all()->count();
        $this->total_companies = Company::all()->count();
        $this->total_hiring_managers = HiringManager::all()->count();
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard')->layout(Layouts::ADMIN->value);
    }
}
