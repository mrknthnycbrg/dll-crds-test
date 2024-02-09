<?php

namespace App\Livewire\Tools;

use App\Models\Research;
use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class ToolsPage extends Component
{
    public $input = '';

    public $output = '';

    public $titleCheckInput = '';

    public $abstractCheckInput = '';

    public $similarTitles = [];

    public $similarAbstracts = [];

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

    public function titleCheckerResponse()
    {
        $this->similarTitles = [];

        if (! empty($this->titleCheckInput)) {
            $allTitles = Research::where('published', true)
                ->pluck('title')
                ->map(fn ($title) => trim($title));

            $inputTitle = trim($this->titleCheckInput);

            $allTitles->each(function ($title) use ($inputTitle) {
                similar_text(strtolower($inputTitle), strtolower($title), $percentage);

                if ($percentage >= 50) {
                    $formattedPercentage = $percentage == round($percentage)
                        ? number_format($percentage, 0).'%'
                        : number_format($percentage, 2, '.', '').'%';

                    $this->similarTitles[] = [
                        'title' => $title,
                        'percentage' => $formattedPercentage,
                    ];
                }
            });
        }
    }

    public function abstractCheckerResponse()
    {
        $this->similarAbstracts = [];

        if (! empty($this->abstractCheckInput)) {
            $allAbstracts = Research::where('published', true)
                ->pluck('abstract')
                ->map(fn ($abstract) => trim(strip_tags($abstract)));

            $inputAbstract = trim(strip_tags($this->abstractCheckInput));

            $allAbstracts->each(function ($abstract) use ($inputAbstract) {
                similar_text(strtolower($inputAbstract), strtolower($abstract), $percentage);

                if ($percentage >= 50) {
                    $formattedPercentage = $percentage == round($percentage)
                        ? number_format($percentage, 0).'%'
                        : number_format($percentage, 2, '.', '').'%';

                    $this->similarAbstracts[] = [
                        'abstract' => $abstract,
                        'percentage' => $formattedPercentage,
                    ];
                }
            });
        }
    }

    public function render()
    {
        return view('livewire.tools.tools-page')
            ->layout('layouts.app')
            ->title('Tools - DLL-CRDS');
    }
}
