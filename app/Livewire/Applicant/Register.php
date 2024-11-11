<?php

namespace App\Livewire\Applicant;

use App\Enums\ApplicantGender;
use App\Enums\Layouts;
use App\Enums\UserRole;
use App\Mail\ApplicantAccountOTP;
use App\Models\Applicant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

class Register extends Component
{

    public $showPassword = false;

    #[Rule('required|string')]
    public $first_name;
    public $middle_name;
    #[Rule('required|string')]
    public $last_name;
    #[Rule('required|email|unique:users')]
    public $email;
    #[Rule('required|string|unique:users|min:11|max:11')]
    public $phone_no = "09";
    #[Rule('required|string|same:confirm_password|min:7')]
    public $password;
    #[Rule('required|string')]
    public $confirm_password;
    #[Rule('required|string')]
    public $gender;


    public $MALE = ApplicantGender::MALE->value + 1;
    public $FEMALE = ApplicantGender::FEMALE->value + 1;


    public function save()
    {

        if (!preg_match('/^[0-9+-]+$/', $this->phone_no)) {
            $this->phone_no = substr($this->phone_no, 0, -1);
        }
        $this->validate();
        $otp  = rand(100000, 999999);
        $expiration = Carbon::now()->addMinutes(5);
        $user_data = [
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'phone_no' => $this->phone_no,
            'password' => Hash::make($this->password),
            'gender' => $this->gender,
            'otp' => $otp,
            'expiration' => $expiration
        ];
        Session::put('register', $user_data);
        Mail::to($user_data['email'])->send(new ApplicantAccountOTP($user_data['otp']));

        return $this->redirect('/checkpoint', navigate: true);
    }

    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
    }
    public function render()
    {
        return view('livewire.applicant.register')->layout(Layouts::APPLICANT->value);
    }
}
