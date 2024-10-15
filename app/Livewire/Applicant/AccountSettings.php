<?php

namespace App\Livewire\Applicant;

use App\Enums\Layouts;
use App\Models\Applicant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class AccountSettings extends Component
{
    public $provinces = ["BUKIDNON", "CAMIGUIN", "LANAO DEL NORTE", "MISAMIS OCCIDENTAL", "MISAMIS ORIENTAL", "COMPOSTELA VALLEY", "DAVAO (DAVAO DEL NORTE)", "DAVAO DEL SUR", "DAVAO OCCIDENTAL", "DAVAO ORIENTAL", "COTABATO (NORTH COT.)", "SARANGANI", "SOUTH COTABATO", "SULTAN KUDARAT", "AGUSAN DEL NORTE", "AGUSAN DEL SUR", "DINAGAT ISLANDS", "SURIGAO DEL NORTE", "SURIGAO DEL SUR", "ILOCOS NORTE", "ILOCOS SUR", "LA UNION", "PANGASINAN", "BATANES", "CAGAYAN", "ISABELA", "NUEVA VIZCAYA", "QUIRINO", "AURORA", "BATAAN", "BULACAN", "NUEVA ECIJA", "PAMPANGA", "TARLAC", "ZAMBALES", "BATANGAS", "CAVITE", "LAGUNA", "QUEZON", "RIZAL", "MARINDUQUE", "OCCIDENTAL MINDORO", "ORIENTAL MINDORO", "PALAWAN", "ROMBLON", "ALBAY", "CAMARINES NORTE", "CAMARINES SUR", "CATANDUANES", "MASBATE", "SORSOGON", "AKLAN", "ANTIQUE", "CAPIZ", "GUIMARAS", "ILOILO", "NEGROS OCCIDENTAL", "BOHOL", "CEBU", "NEGROS ORIENTAL", "SIQUIJOR", "BILIRAN", "EASTERN SAMAR", "LEYTE", "NORTHERN SAMAR", "SAMAR (WESTERN SAMAR)", "SOUTHERN LEYTE", "ZAMBOANGA DEL NORTE", "ZAMBOANGA DEL SUR", "ZAMBOANGA SIBUGAY", "BASILAN", "LANAO DEL SUR", "MAGUINDANAO", "SULU", "TAWI-TAWI", "ABRA", "APAYAO", "BENGUET", "IFUGAO", "KALINGA", "MOUNTAIN PROVINCE", "NATIONAL CAPITAL REGION - FOURTH DISTRICT", "NATIONAL CAPITAL REGION - MANILA", "NATIONAL CAPITAL REGION - SECOND DISTRICT", "NATIONAL CAPITAL REGION - THIRD DISTRICT", "TAGUIG - PATEROS"];
    use WithFileUploads;

    public $applicant;
    public $user;
    public $first_name;
    public $last_name;
    public $middle_name;
    public $image;
    public $gender;

    public $phone_no;
    public $telephone_no;
    public $email;

    public $address;
    public $street;
    public $barangay;
    public $city;
    public $province;

    public $about;

    public $old_password;
    public $new_password;
    public $confirm_password;

    public $edu_attainment;
    public $resume;
    public $applicant_resume;
    public $showPassword = false;
    public function mount()
    {
        $this->applicant = Applicant::where('user_id', Auth::user()->id)->firstOrFail();
        $this->user = $this->applicant->user()->get()->firstOrFail();
        $this->address = $this->applicant->address()->get()->first();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->middle_name = $this->user->middle_name;
        $this->gender = $this->applicant->gender;
        $this->phone_no = $this->user->phone_no;
        $this->email = $this->user->email;
        $this->telephone_no = $this->user->telephone_no;
        $this->about = $this->applicant->about;
        $this->edu_attainment = $this->applicant->edu_attainment;
        $this->applicant_resume = $this->applicant->resume;
    }

    public function saveChangesAccountInformation()
    {

        $this->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'image' => 'nullable|sometimes|image',
            'gender' => 'required|numeric',
            'edu_attainment' => 'nullable',
            'resume' => 'nullable|mimes:pdf|max:10240'
        ]);

        if ($this->image) {
            $profile = $this->image->store('profile/user', 'public');
            $applicant = $this->applicant->fill(['profile' => $profile]);
            $changeProfile = $applicant->getDirty();
            if ($changeProfile) {
                $this->applicant->update($changeProfile);
            }
        }

        if ($this->resume) {
            $resume = $this->resume->store('resume', 'public');
            $applicant = $this->applicant->fill(['resume' => $resume]);
            $changeResume = $applicant->getDirty();

            if ($changeResume) {
                $this->applicant->update($changeResume);
            }
        }
        $applicant = $this->applicant->fill(
            [
                'gender' => $this->gender,
                'edu_attainment' => $this->edu_attainment
            ]
        );

        $applicantChanges = $applicant->getDirty();

        if ($applicantChanges) {
            $this->applicant->update($applicantChanges);
        }
        $user = $this->user->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name
        ]);

        $userChanges = $user->getDirty();

        if ($userChanges) {
            $this->user->update($userChanges);
        }


        return redirect('my/account/setting');
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

        return redirect('my/account/setting');
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

        return redirect('my/account/setting');
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

        return redirect('my/account/setting');
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
            return redirect('my/account/setting');
        }

        $this->street = "";
        $this->barangay = "";
        $this->city = "";
        $this->province = "";
    }


    public function saveAbout()
    {
        $this->validate(['about' => 'string|required']);

        $applicant = $this->applicant->fill(['about' => $this->about]);
        $changes = $applicant->getDirty();
        if ($changes) {
            $this->applicant->update($changes);


            return redirect('my/account/setting');
        }
    }


    public function changePassword()
    {
        $this->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:7|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        if (Hash::check($this->old_password, $this->user->password)) {
            $new_password = $this->new_password;
            $this->user->password = Hash::make($new_password);
            $this->user->save();

            auth()->logout();
            session()->regenerate();
            return redirect('/login');
        }
        return $this->addError('old_password', 'Invalid Password');
    }

    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function render()
    {
        return view('livewire.applicant.account-settings')->layout(Layouts::APPLICANT->value);
    }
}
