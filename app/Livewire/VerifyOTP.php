<?php

namespace App\Livewire;

use App\Enums\Layouts;
use App\Mail\SendOTP;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class VerifyOTP extends Component
{
    public $otp;
    public $email;
    public $resend_otp_time;
    public $time_remaining;
    public $otp_expiration;

    public function mount()
    {
        $this->email = Session::get('email');
        $this->otp_expiration = Session::get('otp_expiration');
        $this->resend_otp_time = Carbon::now()->addMinute();
        $this->time_remaining = Carbon::parse($this->resend_otp_time)->diffInSeconds(Carbon::now());
    }

    public function calculateTimeRemaining()
    {
        $now = Carbon::now();

        $resend_otp_time = Carbon::parse($this->resend_otp_time);
        if ($now->greaterThan($resend_otp_time)) {
            $this->time_remaining = 0;
        } else {
            $this->time_remaining = $resend_otp_time->diffInSeconds($now);
        }
    }
    public function verifyOTP()
    {
        $this->validate([
            'otp' => 'required'
        ]);

        $expiration = Carbon::parse($this->otp_expiration);
        $now = Carbon::now();
        $validOtp = Session::get('otp');
        if ($now->greaterThan($expiration)) {
            $this->addError('otp', 'Invalid/Expired OTP.');
            return;
        }

        if ($validOtp != $this->otp) {
            $this->addError('otp', 'Invalid/Expired OTP.');
            return;
        }

        Session::put("verified_forgot_password", true);

        redirect('/change-password');
    }


    public function resendOTP()
    {

        $otp  = rand(100000, 999999);
        $expiration = Carbon::now()->addMinutes(5);
        Session::put('otp', $otp);
        Session::put('otp_expiration', $expiration);
        Mail::to($this->email)->send(new SendOTP($otp));

        $this->resend_otp_time = Carbon::now()->addMinute();
    }
    public function render()
    {
        return view('livewire.verify-o-t-p')->layout(Layouts::APPLICANT->value);
    }
}
