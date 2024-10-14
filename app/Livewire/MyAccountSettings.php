<?php

namespace App\Livewire;

use App\Enums\Layouts;
use App\Enums\UserRole;
use App\Models\HiringManager;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class MyAccountSettings extends Component
{
    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];


    public User $user;
    public string $first_name;
    public string $last_name;
    public $middle_name;
    public string $phone_no;
    public string $email;
    public  $telephone_no;
    public bool $showPassword = false;

    public string $old_password;
    public string $new_password;
    public string $confirm_password;

    public $address;
    public $street;
    public $barangay;
    public $city;
    public $province;

    public int $HM_ROLE = UserRole::HIRING_MANAGER->value;

    public HiringManager $hiring_manager;

    public function mount()
    {
        if (
            Auth::check() &&
            (Auth::user()->role !== UserRole::ADMIN->value ||
                Auth::user()->role !== UserRole::HIRING_MANAGER->value)
        ) {
            $this->user = User::find(Auth::user()->id);

            $this->first_name = $this->user->first_name;
            $this->last_name = $this->user->last_name;
            $this->middle_name = $this->user->middle_name;
            $this->phone_no = $this->user->phone_no;
            $this->email = $this->user->email;
            $this->telephone_no = $this->user->telephone_no;
            if ($this->user->role === $this->HM_ROLE) {
                $this->hiring_manager =
                    HiringManager::where('user_id', Auth::user()->id)->first();
                $this->address = $this->hiring_manager->address()->get()->first();
                $this->street = $this->address->street;
                $this->barangay = $this->address->barangay;
                $this->city = $this->address->city;
                $this->province = $this->address->province;
            }
        } else {
            return redirect('/login');
        }
    }
    public function saveAddress()
    {
        $this->validate([
            'street' => 'required|string',
            'barangay' => 'required|string',
            'city' => 'required|string',
            'province' => 'required|string'
        ]);

        if ($this->address) {
            $address = $this->address->fill([
                'street' => $this->street,
                'barangay' => $this->barangay,
                'city' => $this->city,
                'province' => $this->province
            ]);

            $changes = $address->getDirty();

            if ($changes) {
                $this->address->update($changes);
            }

            return redirect('my/account/setting');
        } else {
            $address = $this->applicant->address()->create([
                'street' => $this->street,
                'barangay' => $this->barangay,
                'city' => $this->city,
                'province' => $this->province
            ]);
            $this->applicant->update(['address_id' => $address->id]);
            return redirect('account-settings');
        }

        $this->street = "";
        $this->barangay = "";
        $this->city = "";
        $this->province = "";
    }
    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
    }
    public function saveChangesAccountInformation()
    {

        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
        ]);


        $user = $this->user->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name
        ]);

        $userChanges = $user->getDirty();

        if ($userChanges) {
            $this->user->update($userChanges);
        }

        return redirect('account-settings');
    }

    public function changeUserPhone()
    {
        $this->validate([
            'phone_no' => 'required|string|unique:users',
        ]);

        $user = $this->user->fill([
            'phone_no' => $this->phone_no,
        ]);

        $changes  = $user->getDirty();

        if ($changes) {
            $this->user->update($changes);
        }

        return redirect('account-settings');
    }

    public function changeUserEmail()
    {
        $this->validate([
            'email' => 'required|string|unique:users|email'
        ]);

        $user = $this->user->fill([
            'email' => $this->email
        ]);

        $changes  = $user->getDirty();

        if ($changes) {
            $this->user->update($changes);
        }

        return redirect('account-settings');
    }

    public function saveChangesTelephone()
    {
        $this->validate([
            'telephone_no' => 'required|string',
        ]);

        $user = $this->user->fill([
            'telephone_no' => $this->telephone_no,
        ]);

        $changes  = $user->getDirty();

        if ($changes) {
            $this->user->update($changes);
        }

        return redirect('account-settings');
    }

    public function changePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:7|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        if (Hash::check($this->old_password, $this->user->password)) {
            $this->user->password = $this->new_password;
            $this->user->save();

            auth()->logout();
            session()->regenerate();
            return redirect('/login');
        }
        return $this->addError('old_password', 'Invalid Password');
    }

    public function render()
    {
        if (
            Auth::check() &&
            (Auth::user()->role !== UserRole::ADMIN->value ||
                Auth::user()->role !== UserRole::HIRING_MANAGER->value)
        ) {
            $layout = Auth::user()->role === UserRole::ADMIN->value ? Layouts::ADMIN->value : Layouts::HM->value;
            return view('livewire.my-account-settings')->layout($layout);
        } else {

            return redirect('/login');
        }
    }
}
