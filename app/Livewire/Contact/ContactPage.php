<?php

namespace App\Livewire\Contact;

use Livewire\Component;

class ContactPage extends Component
{
    public function render()
    {
        return view('livewire.contact.contact-page')
            ->title('Contact Us - DLL-CRDS');
    }
}
