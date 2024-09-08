<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Livewire\Admin\Company;
use App\Livewire\Admin\CreateCompany;
use App\Livewire\Admin\CreateHiringManager;
use App\Livewire\Admin\EditCompany;
use App\Livewire\Admin\EditHiringManager;
use App\Livewire\Admin\HiringManager;
use App\Livewire\Hm\CreateJob;
use App\Livewire\Hm\Job;
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

Route::get('/login', [UserController::class, 'login']);
Route::post('/signin', [UserController::class, 'signin']);


Route::get('/job', Job::class);
Route::get('/job/create', CreateJob::class);
