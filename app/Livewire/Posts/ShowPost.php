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
        return view('livewire.posts.show-post')
            ->layout('layouts.guest')
            ->title($this->post->title.' - DLL-CRDS');
    }
}
