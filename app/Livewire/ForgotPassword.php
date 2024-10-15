<?php

namespace App\Livewire;

use App\Enums\Layouts;
use App\Mail\SendOTP;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ForgotPassword extends Component
{

    public $email;
    public function sendOTP()
    {
        $this->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {
            $this->addError('email', 'No user found with that email address.');
            return;
        }

        $otp  = rand(100000, 999999);
        $expiration = Carbon::now()->addMinutes(5);
        Session::put('otp', $otp);
        Session::put('otp_expiration', $expiration);
        Session::put('email', $user->email);
        Session::put('user_forgot_password', true);

        Mail::to($user->email)->send(new SendOTP($otp));

        return redirect('/verify-otp');
    }
    public function render()
    {
        return view('livewire.forgot-password')->layout(Layouts::APPLICANT->value);
    }
}
