<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminOnly;
use App\Http\Middleware\ApplicantOnly;
use App\Http\Middleware\HiringManagerOnly;
use App\Http\Middleware\IsApplicantExist;
use App\Http\Middleware\IsCompanyExist;
use App\Http\Middleware\IsJobExist;
use App\Http\Middleware\isLogin;
use App\Http\Middleware\IsUserExist;
use App\Http\Middleware\isUserForgotPassword;
use App\Http\Middleware\isVerifiedForgotPassword;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\ApplicantProfile as AdminApplicantProfile;
use App\Livewire\Admin\Applicants;
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
use App\Livewire\Applicant\JobDetails;
use App\Livewire\Applicant\Jobs;
use App\Livewire\Applicant\MyJobs;
use App\Livewire\Applicant\Profile;
use App\Livewire\Hm\CreateJob;
use App\Livewire\Hm\Dashboard;
use App\Livewire\Hm\EditJob;
use App\Livewire\Hm\Job;
use App\Livewire\Applicant\Register;
use App\Livewire\ChangeForgotPassword;
use App\Livewire\ForgotPassword;
use App\Livewire\Hm\ApplicantDetails;
use App\Livewire\Hm\ApplicantProfile;
use App\Livewire\Hm\MyCompany;
use App\Livewire\Hm\PreviewJob;
use App\Livewire\MyAccountSettings;
use App\Livewire\VerifyOTP;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/account-settings', MyAccountSettings::class);

Route::middleware([isLogin::class, 'guest'])->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', Register::class);
    Route::get('/forgot-password', ForgotPassword::class);
    Route::get('/verify-otp', VerifyOTP::class)->middleware(isUserForgotPassword::class);
    Route::get('/change-password', ChangeForgotPassword::class)->middleware(isVerifiedForgotPassword::class);
});
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::middleware([IsUserExist::class, 'auth'])->group(function () {


    Route::middleware([AdminOnly::class])->group(function () {
        Route::get('/dashboard', AdminDashboard::class);
        Route::get('/hiringmanager', HiringManager::class);
        Route::get('/hiringmanager/create', CreateHiringManager::class);
        Route::get('/hiringmanager/edit/{id}', EditHiringManager::class);
        Route::get('/applicants', Applicants::class);
        Route::get('/company', Company::class);
        Route::get('/company/create', CreateCompany::class);
        Route::get('/applicants/profile/{applicant}', AdminApplicantProfile::class)->middleware(IsApplicantExist::class);
        Route::get('/company/edit/{id}', EditCompany::class);
    });

    Route::middleware([ApplicantOnly::class])->group(function () {
        Route::get('/my/profile', Profile::class);
        Route::get('/my/profile/create/education', CreateEducation::class);
        Route::get('/my/profile/edit/education/{id}', EditEducation::class);
        Route::get('/my/profile/create/skill', CreateSkill::class);
        Route::get('/my/profile/create/experience', CreateExperience::class);
        Route::get('/my/profile/edit/experience/{id}', EditExperience::class);
        Route::get('/my/account/setting', AccountSettings::class);
        Route::get('/my/jobs', MyJobs::class);
        Route::get('/jobs', Jobs::class);
        Route::get('/jobs/{job}', JobDetails::class)->middleware(IsJobExist::class);
    });



    Route::middleware([IsCompanyExist::class, HiringManagerOnly::class])->group(function () {
        Route::get('/hiringmanager/dashboard', Dashboard::class);
        Route::get('/my/job', Job::class);
        Route::get('/my/company', MyCompany::class);
        Route::get('/my/job/create', CreateJob::class);
        Route::get('/my/job/{job}/applicants', ApplicantDetails::class);
        Route::get('/my/job/{job}/applicant/profile/{applicant}', ApplicantProfile::class)->middleware(IsApplicantExist::class);
        Route::middleware([IsJobExist::class])->group(function () {
            Route::get('/my/job/edit/{job}', EditJob::class);
            Route::get('/my/job/preview/{job}', PreviewJob::class);
        });
    });
});
