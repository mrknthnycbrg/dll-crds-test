<?php

namespace App\Filament\Widgets;

use App\Models\Adviser;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class AdviserChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;

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
                    'backgroundColor' => ['#155e75', '#0891b2', '#075985', '#0284c7', '#1e40af', '#2563eb', '#3730a3', '#4f46e5', '#0e7490', '#06b6d4', '#0369a1', '#0ea5e9', '#1d4ed8', '#3b82f6', '#4338ca', '#6366f1'],
                    'borderColor' => '#f3f4f6',
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
