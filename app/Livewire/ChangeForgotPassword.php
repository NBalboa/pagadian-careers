<?php

namespace App\Livewire;

use App\Enums\Layouts;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChangeForgotPassword extends Component
{

    public $showPassword = false;
    public $new_password;
    public $confirm_password;
    public $email;
    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
        $this->email = Session::get("email");
    }

    public function changePassword()
    {

        $this->validate([
            'new_password' => 'required|min:7|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $user = User::where('email', $this->email)->get()->first();
        $new_password = $this->new_password;
        $user->password = Hash::make($new_password);
        $user->save();
        Session::forget(['otp', 'email', 'otp_expiration', 'user_forgot_password', 'verified_forgot_password']);
        return redirect('/login');
    }
    public function render()
    {
        return view('livewire.change-forgot-password')->layout(Layouts::APPLICANT->value);
    }
}
