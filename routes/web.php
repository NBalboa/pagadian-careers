<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\AccountVerification;
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
use App\Livewire\Applicant\VerifyEmailApplicant;
use App\Livewire\ChangeForgotPassword;
use App\Livewire\ForgotPassword;
use App\Livewire\Hm\ApplicantDetails;
use App\Livewire\Hm\ApplicantProfile;
use App\Livewire\Hm\MyCompany;
use App\Livewire\Hm\PreviewJob;
use App\Livewire\MyAccountSettings;
use App\Livewire\VerifyOTP;
use App\Livewire\Welcome;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Artisan;

// Route::get('/storage-link', function () {
//     Artisan::call('storage:link');

//     return "Storage link created successfully!";
// });

Route::get('/', Welcome::class)->name('home');


Route::get('/account-settings', MyAccountSettings::class)->name('admin.settings');

Route::middleware([isLogin::class, 'guest'])->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::get('/register', Register::class)->name('register')->name('register');
    Route::get('/checkpoint', VerifyEmailApplicant::class)->middleware(AccountVerification::class);
    Route::get('/forgot-password', ForgotPassword::class);
    Route::get('/verify-otp', VerifyOTP::class)->middleware(isUserForgotPassword::class);
    Route::get('/change-password', ChangeForgotPassword::class)->middleware(isVerifiedForgotPassword::class);
});
Route::post('/signin', [UserController::class, 'signin']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::middleware([IsUserExist::class, 'auth'])->group(function () {


    Route::middleware([AdminOnly::class])->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/hiringmanager', HiringManager::class)->name('admin.hm');
        Route::get('/hiringmanager/create', CreateHiringManager::class)->name('admin.create.hm');
        Route::get('/hiringmanager/edit/{id}', EditHiringManager::class)->name('admin.edit.hm');
        Route::get('/applicants', Applicants::class)->name('admin.applicants');
        Route::get('/company', Company::class)->name('admin.company');
        Route::get('/company/create', CreateCompany::class)->name('admin.company.create');
        Route::get('/company/edit/{id}', EditCompany::class)->name('admin.company.edit');
        Route::get('/applicants/profile/{applicant}', AdminApplicantProfile::class)->middleware(IsApplicantExist::class);
    });

    Route::middleware([ApplicantOnly::class])->group(function () {
        Route::get('/my/profile', Profile::class)->name('my/profile');
        Route::get('/my/profile/create/education', CreateEducation::class)->name('app.edu.create');
        Route::get('/my/profile/edit/education/{id}', EditEducation::class)->name('app.edu.edit');
        Route::get('/my/profile/create/skill', CreateSkill::class)->name('app.skill.create');
        Route::get('/my/profile/create/experience', CreateExperience::class)->name('app.create.exp');
        Route::get('/my/profile/edit/experience/{id}', EditExperience::class)->name('app.edit.exp');
        Route::get('/my/account/setting', AccountSettings::class)->name('app.settings');
        Route::get('/my/jobs', MyJobs::class)->name('my/jobs');
        Route::get('/jobs', Jobs::class)->name('jobs');
        Route::get('/jobs/{job}', JobDetails::class)->middleware(IsJobExist::class)->name('app.job');
    });



    Route::middleware([IsCompanyExist::class, HiringManagerOnly::class])->group(function () {
        Route::get('/hiringmanager/dashboard', Dashboard::class)->name('hm.dashboard');
        Route::get('/my/job', Job::class)->name('hm.my.job');
        Route::get('/my/company', MyCompany::class)->name('hm.my.company');
        Route::get('/my/job/create', CreateJob::class)->name('hm.job.create');
        Route::get('/my/job/{job}/applicants', ApplicantDetails::class)->name('hm.applicant.details');
        Route::get('/my/job/{job}/applicant/profile/{applicant}', ApplicantProfile::class)->middleware(IsApplicantExist::class)->name('hm.applicant.profile');
        Route::middleware([IsJobExist::class])->group(function () {
            Route::get('/my/job/edit/{job}', EditJob::class)->name('hm.job.edit');
            Route::get('/my/job/preview/{job}', PreviewJob::class)->name('hm.job.preview');
        });
    });
});
