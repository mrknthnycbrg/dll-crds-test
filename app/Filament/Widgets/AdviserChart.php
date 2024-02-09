<?php

namespace App\Filament\Widgets;

use App\Models\Adviser;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class AdviserChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected static ?string $heading = 'Researches by Adviser';

    protected function getData(): array
    {
        $data = Adviser::withCount('researches')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Advisers',
                    'data' => $data->pluck('researches_count')->toArray(),
                    'backgroundColor' => ['#1e40af', '#3730a3', '#2563eb', '#4f46e5', '#60a5fa', '#818cf8', '#1d4ed8', '#4338ca', '#3b82f6', '#6366f1'],
                    'borderColor' => '#93c5fd',
                    'animation' => [
                        'duration' => 1500,
                    ],
                ],
            ],
            'labels' => $data->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'display' => false,
                ],
                'y' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
