<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class CategoryChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected static ?string $heading = 'Posts by Category';

    protected function getData(): array
    {
        $data = Category::withCount('posts')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Categories',
                    'data' => $data->pluck('posts_count')->toArray(),
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
