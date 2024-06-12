<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class PostsByAuthorChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $pollingInterval = '60s';

    protected static ?int $sort = 7;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '50vh';

    protected static ?string $heading = 'Posts by Author';

    protected function getData(): array
    {
        $data = Author::withCount('posts')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Authors',
                    'data' => $data->pluck('posts_count')->toArray(),
                    'backgroundColor' => ['#1e40af', '#3730a3', '#2563eb', '#4f46e5', '#60a5fa', '#818cf8', '#1d4ed8', '#4338ca', '#3b82f6', '#6366f1'],
                    'borderColor' => '#e5e7eb',
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
