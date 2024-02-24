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
        return view('livewire.downloadables.show-downloadable')
            ->title($this->downloadable->name.' - DLL-CRDS');
    }

    public function file()
    {
        $this->redirectRoute('file-downloadable', ['slug' => $this->downloadable->slug]);
    }
}
