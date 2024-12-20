<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function login()
    {
        return view('login');
    }

    public function signin(Request $request)
    {
        $attributes = $request->validate([
            'emailOrPhone' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $attributes['emailOrPhone'])->orWhere('phone_no', $attributes['emailOrPhone'])->first();

        if ($user && Hash::check($attributes['password'], $user->password)) {
            Auth::login($user);
            session()->regenerate();
            $role = auth()->user()->role;

            if (UserRole::ADMIN->value == $role) {
                return redirect('/dashboard');
            } else if (UserRole::HIRING_MANAGER->value === $role) {
                return redirect('/hiringmanager/dashboard');
            } else {
                return redirect('/jobs');
            }
        } else {
            return redirect('login')->withInput()->withErrors(['error' => 'Invalid Email/Phone and Password']);
        }
    }

    public function logout()
    {
        auth()->logout();
        session()->regenerate();
        return redirect('/');
    }
}
