<?php

namespace App\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikeComponent extends Component
{
    public $post_id;
    public $isLiked;

    public function mount($postId)
    {
        $this->post_id = $postId;
        // Check if the user is authenticated
        if (auth()->user() === null)
        {
            $this->isLiked = false;
            return;
        }
        $checker = Like::where([['user_id',auth()->user()->id],['post_id',$this->post_id]])->first();
        $this->isLiked = $checker == null ? false : true;
    }

    public function likeUnlike()
    {
        if (auth()->user() === null)
        {
            return;
        }

        if ($this->isLiked == false)
        {
            $this->isLiked = true;

            $likePost = new Like;
            $likePost->user_id = auth()->user()->id;
            $likePost->post_id = $this->post_id;
            $likePost->save();
        }
        else
        {
            $this->isLiked = false;
            Like::where([['user_id',auth()->user()->id],['post_id',$this->post_id]])
            ->delete();
        }
    }

    public function render()
    {
        return view('livewire.like-component',[
            'likesCount' => Like::where('post_id',$this->post_id)->count()
        ]);
    }
}
