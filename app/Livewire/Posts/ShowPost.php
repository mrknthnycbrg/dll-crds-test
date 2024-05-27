<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class ShowPost extends Component
{
    public $post;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $otherPosts = Post::with('category')
            ->where('published', true)
            ->where('category_id', $this->post->category_id)
            ->where('id', '!=', $this->post->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('livewire.posts.show-post', compact('otherPosts'))
            ->title($this->post->title.' - DLL-CRDS');
    }
}
