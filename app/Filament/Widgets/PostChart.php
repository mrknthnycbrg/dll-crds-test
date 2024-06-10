<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class PostChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $pollingInterval = '60s';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 3;

    protected static ?string $maxHeight = '300px';

    protected static ?string $heading = 'Posts by Date';

    public ?string $filter = 'all';

    protected function getFilters(): ?array
    {
        return [
            'all' => 'All time',
            'year' => 'This year',
            'month' => 'This month',
            'week' => 'This week',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $data = match ($activeFilter) {
            'all' => Trend::model(Post::class)
                ->dateColumn('date_published')
                ->between(
                    start: Carbon::parse(Post::min('date_published')),
                    end: Carbon::parse(Post::max('date_published')),
                )
                ->perMonth()
                ->count(),
            'year' => Trend::model(Post::class)
                ->dateColumn('date_published')
                ->between(
                    start: today()->startOfYear(),
                    end: today()->endOfYear(),
                )
                ->perMonth()
                ->count(),
            'month' => Trend::model(Post::class)
                ->dateColumn('date_published')
                ->between(
                    start: today()->startOfMonth(),
                    end: today()->endOfMonth(),
                )
                ->perDay()
                ->count(),
            'week' => Trend::model(Post::class)
                ->dateColumn('date_published')
                ->between(
                    start: today()->startOfWeek(0),
                    end: today()->endOfWeek(6),
                )
                ->perDay()
                ->count(),
            default => Trend::model(Post::class)
                ->dateColumn('date_published')
                ->between(
                    start: Carbon::parse(Post::min('date_published')),
                    end: Carbon::parse(Post::max('date_published')),
                )
                ->perMonth()
                ->count(),
        };

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#1e40af',
                    'borderColor' => '#e5e7eb',
                    'animation' => [
                        'duration' => 1500,
                    ],
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'scale' => [
                'ticks' => [
                    'precision' => 0,
                ],
            ],
        ];
    }
}
