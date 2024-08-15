<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\UserProfile;

class ProfileImageEdit extends Component
{
    use WithFileUploads;

    public $existingImage;
    public $image;

    public function uploadImage()
    {
         $this->validate([
            'image' => 'required',
        ]);
        $photo_name = md5($this->image . microtime()).'.'.$this->image->extension();
        $this->image->storeAs('public/images', $photo_name);

        $add_photo = UserProfile::where('user_id',auth()->user()->id)->update([
            'image' => $photo_name
        ]);
        return $this->redirect('/profile',navigate: true);
    }

    public function render()
    {
        return view('livewire.profile-image-edit');
    }
}
