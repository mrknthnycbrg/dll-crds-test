<?php

namespace App\Livewire\Welcome;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class WelcomePage extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::where('published', true)
            ->latest('date_published')
            ->paginate(6);

        return view('livewire.welcome.welcome-page', compact('posts'))
            ->layout('layouts.guest');
    }
}
