<?php

namespace App\Livewire\Submit;

use App\Models\Submission;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class SubmitPage extends Component
{
    use WithFileUploads;

    public $user_email;

    public $file;

    public function mount()
    {
        $this->user_email = Auth::user()->email;
    }

    public function save()
    {
        $this->validate([
            'user_email' => 'required|email',
            'file' => 'required|file',
        ]);

        $originalFilename = $this->file->getClientOriginalName();

        $filePath = $this->file->storeAs(path: 'submission-files', name: $originalFilename);

        Submission::create([
            'user_email' => $this->user_email,
            'file_path' => $filePath,
            'date_submitted' => now(),
        ]);

        return redirect('/submit')
            ->with('status', 'Submission successful!');
    }

    public function render()
    {
        return view('livewire.submit.submit-page')
            ->title('Submit - DLL-CRDS');
    }
}
