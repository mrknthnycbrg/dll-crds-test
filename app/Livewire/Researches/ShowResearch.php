<?php

namespace App\Livewire\Researches;

use App\Models\Research;
use Livewire\Component;

class ShowResearch extends Component
{
    public $research;

    public function mount($slug)
    {
        $this->research = Research::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.researches.show-research')
            ->layout('layouts.app')
            ->title($this->research->title.' - DLL-CRDS');
    }

    public function file()
    {
        $this->redirectRoute('file-research', ['slug' => $this->research->slug]);
    }
}
