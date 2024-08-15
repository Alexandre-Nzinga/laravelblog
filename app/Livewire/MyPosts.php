<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
Use App\Models\User;
use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;

class MyPosts extends Component
{
    public $my_posts;
    public $my_posts_count;
    public $my_comments_count;
    public $my_followers_count;
    public $my_likes_count;

    public function mount()
    {
        $user_id = auth()->user()->id;
        $this->my_posts = Post::where('user_id',$user_id)->get();
        $this->my_posts_count = Post::where('user_id',$user_id)->count();
        $this->my_comments_count = Comment::where('user_id',$user_id)->count();
        $this->my_followers_count = Follower::where('followed_id',$user_id)->count();
        $this->my_likes_count = Like::where('user_id',$user_id)->count();
    }
    public function deletePost($id)
    {
        Post::where('id',$id)->delete();
        session()->flash('message', ['type' => 'danger', 'text' => 'Post deleted!']);
        return $this->redirect('/my/posts', navigate: true);
    }

    public function render()
    {
        return view('livewire.my-posts',[
            'posts' => $this->my_posts,
            'post_count' => $this->my_posts_count,
            'comments_count' => $this->my_comments_count,
            'followers_count' => $this->my_followers_count,
            'likes_count' => $this->my_likes_count

        ]);

    }
}
