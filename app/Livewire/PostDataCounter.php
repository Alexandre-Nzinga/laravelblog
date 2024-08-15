<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Like;
use Livewire\Component;

class PostData extends Component
{
    public $postLikes;

    public function mount()
    {
        $this->postLikes = Post::join('likes','likes.post_id','=','posts.id')->where('posts.user_id',auth()->user()->id)->count();
    }

    public function render()
    {
        return view('livewire.post-data-counter');
    }
}
