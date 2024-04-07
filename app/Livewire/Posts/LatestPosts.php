<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class LatestPosts extends Component
{
    public function render()
    {
        $latestPosts = Post::with('category')
            ->where('published', true)
            ->latest('date_published')
            ->take(3)
            ->get();

        return view('livewire.posts.latest-posts', compact('latestPosts'));
    }
}
