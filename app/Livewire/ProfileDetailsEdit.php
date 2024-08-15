<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\UserProfile;

class ProfileDetailsEdit extends Component
{
    public $fullName;

    public $about;
    public $country;
    public $address;
    public $phone;
    public $twitter;
    public $facebook;
    public $instagram;

    public function mount($fullName)
    {
        $this->fullName = $fullName;
    }

    public function editUser()
    {

        $editUser = UserProfile::where('user_id',auth()->user()->id)->update([
            'about' => $this->about,
            'country' => $this->country,
            'phone' => $this->phone,
            'twitter' => $this->twitter,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
        ]);

        $updateUsersTable = User::where('id',auth()->user()->id)->update([
            'name' => $this->fullName
        ]);
        return $this->redirect('/profile',navigate: true);
    }
    public function render()
    {
        return view('livewire.profile-details-edit');
    }
}
