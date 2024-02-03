<?php

namespace App\Livewire\Ask;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class AskPage extends Component
{
    public $input = '';

    public $output = '';

    public $example;

    public function response()
    {
        if (! empty($this->input)) {
            $response = OpenAI::completions()->create([
                'model' => 'gpt-3.5-turbo-instruct',
                'prompt' => 'Suggest at least 5 research titles based on this topic: '.$this->input,
                'max_tokens' => 250,
                'temperature' => 0.5,
            ]);

            $this->output = trim($response['choices'][0]['text']);
        }
    }

    public function render()
    {
        $response = OpenAI::completions()->create([
            'model' => 'gpt-3.5-turbo-instruct',
            'prompt' => 'Suggest 1 topic.',
            'max_tokens' => 50,
            'temperature' => 0.5,
        ]);

        $this->example = trim($response['choices'][0]['text']);

        return view('livewire.ask.ask-page')
            ->layout('layouts.app')
            ->title('Ask AI - DLL-CRDS');
    }
}
