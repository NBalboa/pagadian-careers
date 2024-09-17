<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Enums\UserRole;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

class Register extends Component
{

    public $showPassword = false;

    #[Rule('string|required')]
    public $first_name;
    public $middle_name;
    #[Rule('string|required')]
    public $last_name;
    #[Rule('email|required|unique:users')]
    public $email;
    #[Rule('string|required|unique:users')]
    public $phone_no;
    #[Rule('string|required|same:confirm_password')]
    public $password;
    #[Rule('string|required')]
    public $confirm_password;
    #[Rule('string|required')]
    public $gender;


    public function save()
    {

        if (!preg_match('/^[0-9+-]+$/', $this->phone_no)) {
            $this->phone_no = substr($this->phone_no, 0, -1);
        }

        $this->validate();

        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $this->email,
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'middle_name' => $this->middle_name,
                'phone_no' => $this->phone_no,
                'password' => $this->password,
                'remember_token' => Str::random(10),
                'role' => UserRole::APPLICANTS->value
            ]);

            Applicant::create([
                'user_id' => $user->id,
                'gender' => $this->gender,
                'profile' => ($this->gender === 0 ? 'profile/user/male.jpg' : 'profile/user/female.jpg'),
            ]);

            DB::commit();
            redirect('/')->with(['success' => 'Hiring Manager created successfully']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create Applicant');
            dd($e);
            Log::error('Error creating Hiring Manager: ' . $e->getMessage());
            DB::rollBack();
        }
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
