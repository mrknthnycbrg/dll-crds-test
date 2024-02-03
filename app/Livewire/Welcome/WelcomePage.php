<?php

namespace App\Livewire\Welcome;

use App\Models\Post;
use Livewire\Component;

class WelcomePage extends Component
{
    public function render()
    {
        $latestPosts = Post::with('category')
            ->where('published', true)
            ->latest('date_published')
            ->take(6)
            ->get();

        return view('livewire.welcome.welcome-page', compact('latestPosts'))
            ->layout('layouts.guest');
    }
}
