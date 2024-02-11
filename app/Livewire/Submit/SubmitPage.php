<?php

namespace App\Livewire\Submit;

use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitPage extends Component
{
    use WithFileUploads;

    public $email;

    public $file;

    public function mount()
    {
        $this->email = Auth::user()->email;
    }

    public function save()
    {
        $this->validate([
            'email' => 'required|email',
            'file' => 'required|file|mimes:pdf',
        ]);

        $originalFilename = $this->file->getClientOriginalName();

        $filePath = $this->file->storePubliclyAs(path: 'submission-files', name: $originalFilename);

        Submission::create([
            'email' => $this->email,
            'file_path' => $filePath,
        ]);

        return redirect('/submit')
            ->with('status', 'Submission successful!');
    }

    public function render()
    {
        return view('livewire.submit.submit-page')
            ->layout('layouts.app')
            ->title('Submit - DLL-CRDS');
    }
}
