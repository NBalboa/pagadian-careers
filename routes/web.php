<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\ApplicantOnly;
use App\Http\Middleware\HiringManagerOnly;
use App\Livewire\Admin\Company;
use App\Livewire\Admin\CreateCompany;
use App\Livewire\Admin\CreateHiringManager;
use App\Livewire\Admin\EditCompany;
use App\Livewire\Admin\EditHiringManager;
use App\Livewire\Admin\HiringManager;
use App\Livewire\Applicant\AccountSettings;
use App\Livewire\Applicant\CreateEducation;
use App\Livewire\Applicant\CreateExperience;
use App\Livewire\Applicant\CreateSkill;
use App\Livewire\Applicant\EditEducation;
use App\Livewire\Applicant\EditExperience;
use App\Livewire\Applicant\Jobs;
use App\Livewire\Applicant\Profile;
use App\Livewire\Hm\CreateJob;
use App\Livewire\Hm\Dashboard;
use App\Livewire\Hm\EditJob;
use App\Livewire\Hm\Job;
use App\Livewire\Applicant\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'dashboard']);


Route::get('/hiringmanager', HiringManager::class);
Route::get('/hiringmanager/create', CreateHiringManager::class);
Route::get('/hiringmanager/edit/{id}', EditHiringManager::class);

Route::get('/company', Company::class);
Route::get('/company/create', CreateCompany::class);
Route::get('/company/edit/{id}', EditCompany::class);

Route::get('/login', [UserController::class, 'login'])->middleware('guest')->name('login');
Route::get('/register', Register::class);
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');



Route::middleware([ApplicantOnly::class, 'auth'])->group(function () {
    Route::get('/my/profile', Profile::class);
    Route::get('/my/profile/create/education', CreateEducation::class);
    Route::get('/my/profile/edit/education/{id}', EditEducation::class);
    Route::get('/my/profile/create/skill', CreateSkill::class);
    Route::get('/my/profile/create/experience', CreateExperience::class);
    Route::get('/my/profile/edit/experience/{id}', EditExperience::class);
    Route::get('/my/account/setting', AccountSettings::class);
    Route::get('/jobs', Jobs::class);
});


Route::middleware([HiringManagerOnly::class, 'auth'])->group(function () {
    Route::get('/hiringmanager/dashboard', Dashboard::class);
    Route::get('/my/job', Job::class);
    Route::get('/my/job/create', CreateJob::class);
    Route::get('/my/job/edit/{job}', EditJob::class);
});
