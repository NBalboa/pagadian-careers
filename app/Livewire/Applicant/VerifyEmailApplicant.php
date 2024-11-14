<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Enums\UserRole;
use App\Mail\ApplicantAccountOTP;
use App\Models\Applicant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;

class VerifyEmailApplicant extends Component
{
    public $time_remaining;
    public $user_data;
    public $resend_otp_time;
    public $otp;
    public function mount()
    {
        $this->user_data = Session::get('register');
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

        $expiration = Carbon::parse($this->user_data['expiration']);
        $now = Carbon::now();
        $validOtp = $this->user_data['otp'];

        if ($now->greaterThan($expiration)) {
            $this->addError('otp', 'Invalid/Expired OTP.');
            return;
        }

        if ($validOtp != $this->otp) {
            $this->addError('otp', 'Invalid/Expired OTP.');
            return;
        }

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $this->user_data['email'],
                'first_name' => $this->user_data['first_name'],
                'last_name' => $this->user_data['last_name'],
                'middle_name' => $this->user_data['middle_name'],
                'phone_no' => $this->user_data['phone_no'],
                'password' => $this->user_data['password'],
                'remember_token' => Str::random(10),
                'role' => UserRole::APPLICANTS->value
            ]);

            Applicant::create([
                'user_id' => $user->id,
                'gender' => $this->user_data['gender'] - 1,
                'profile' => ($this->user_data['gender'] - 1 === 0 ? 'profile/user/male.jpg' : 'profile/user/female.jpg'),
            ]);

            Auth::login($user);
            session()->regenerate();
            Session::forget('register');
            DB::commit();

            return $this->redirect('/jobs');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Applicant');
            Log::error('Error creating Applicant: ' . $e->getMessage());
            DB::rollBack();
        }
    }


    public function resendOTP()
    {
        $this->user_data['otp']   = rand(100000, 999999);
        $this->user_data['expiration'] = Carbon::now()->addMinutes(5);
        Mail::to($this->user_data['email'])->send(new ApplicantAccountOTP($this->user_data['otp']));

        $this->resend_otp_time = Carbon::now()->addMinute();
    }
    public function render()
    {
        return view('livewire.applicant.verify-email-applicant')->layout(Layouts::APPLICANT->value);
    }
}
