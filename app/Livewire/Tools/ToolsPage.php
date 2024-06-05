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

    public $similarTitles;

    public $similarAbstracts;

    public function mount()
    {
        $this->similarTitles = collect();
        $this->similarAbstracts = collect();
    }

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
        if (! empty($this->titleCheckInput)) {
            $inputTitle = strtolower(trim($this->titleCheckInput));

            $this->similarTitles = Research::where('published', true)
                ->select('title')
                ->get()
                ->filter(function ($research) use ($inputTitle) {
                    similar_text($inputTitle, strtolower($research->title), $percentage);

                    return $percentage >= 50;
                })
                ->map(function ($research) use ($inputTitle) {
                    similar_text($inputTitle, strtolower($research->title), $percentage);
                    $formattedPercentage = $percentage == round($percentage)
                        ? number_format($percentage, 0).'%'
                        : number_format($percentage, 2, '.', '').'%';

                    return (object) [
                        'title' => $research->title,
                        'percentage' => $formattedPercentage,
                    ];
                });
        }
    }

    public function abstractCheckerResponse()
    {
        if (! empty($this->abstractCheckInput)) {
            $inputAbstract = strtolower(trim($this->abstractCheckInput));

            $this->similarAbstracts = Research::where('published', true)
                ->select('title', 'abstract')
                ->get()
                ->filter(function ($research) use ($inputAbstract) {
                    similar_text($inputAbstract, strtolower($research->abstract), $percentage);

                    return $percentage >= 50;
                })
                ->map(function ($research) use ($inputAbstract) {
                    similar_text($inputAbstract, strtolower($research->abstract), $percentage);
                    $formattedPercentage = $percentage == round($percentage)
                        ? number_format($percentage, 0).'%'
                        : number_format($percentage, 2, '.', '').'%';

                    return (object) [
                        'title' => $research->title,
                        'abstract' => $research->abstract,
                        'percentage' => $formattedPercentage,
                    ];
                });
        }
    }

    public function render()
    {
        return view('livewire.tools.tools-page')
            ->title('Tools - DLL-CRDS');
    }
}
