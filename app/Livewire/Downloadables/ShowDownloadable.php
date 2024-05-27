<?php

namespace App\Livewire\Downloadables;

use App\Models\Downloadable;
use Livewire\Component;

class ShowDownloadable extends Component
{
    public $downloadable;

    public function mount($slug)
    {
        $this->downloadable = Downloadable::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $otherDownloadables = Downloadable::where('published', true)
            ->where('id', '!=', $this->downloadable->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('livewire.downloadables.show-downloadable', compact('otherDownloadables'))
            ->title($this->downloadable->name.' - DLL-CRDS');
    }

    public function file()
    {
        $this->redirectRoute('downloadable-file', ['slug' => $this->downloadable->slug]);
    }
}
