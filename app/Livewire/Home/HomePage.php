<?php

namespace App\Livewire\Home;

use Livewire\Component;

class HomePage extends Component
{
    public function render()
    {
        return view('livewire.home.home-page')
            ->layout('layouts.app')
            ->title('Home - DLL-CRDS');
    }
}
