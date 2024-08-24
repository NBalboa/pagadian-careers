<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function dashboard()
    {
        return view(
            'admin.dashboard'
        );
    }

    public function hiringmanager()
    {
        $companies =  Company::all();

        return view('admin.hiringmanager');
    }
}
