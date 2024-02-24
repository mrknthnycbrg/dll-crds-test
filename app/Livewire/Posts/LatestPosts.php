<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class LatestPosts extends Component
{
    public function render()
    {
        $posts = Post::where('published', true)
            ->latest('date_published')
            ->take(3)
            ->get();

        return view('livewire.posts.latest-posts', compact('posts'));
    }
}
