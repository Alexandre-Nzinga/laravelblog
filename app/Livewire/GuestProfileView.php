<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class GuestProfileView extends Component
{
    public $user_data;
    public $followers;

    public function mount($guestId)
    {
        $this->user_data = User::join('user_profiles','user_profiles.user_id','=','users.id')
        ->where('user_profiles.user_id',$guestId)
        ->first();
    }
    public function render()
    {
        return view('livewire.guest-profile-view');
    }
}
