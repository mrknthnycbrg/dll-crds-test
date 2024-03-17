<?php

namespace App\Filament\Widgets;

use App\Models\Research;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class ResearchChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 3;

    protected static ?string $maxHeight = '300px';

    protected static ?string $heading = 'Researches by Date';

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

        switch ($activeFilter) {
            case 'all':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: Carbon::parse(Research::min('date_submitted')),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'year':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfYear(),
                        end: today()->endOfYear(),
                    )
                    ->perMonth()
                    ->count();
                break;
            case 'month':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfMonth(),
                        end: today()->endOfMonth(),
                    )
                    ->perDay()
                    ->count();
                break;
            case 'week':
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: today()->startOfWeek(0),
                        end: today()->endOfWeek(6),
                    )
                    ->perDay()
                    ->count();
                break;
            default:
                $data = Trend::model(Research::class)
                    ->dateColumn('date_submitted')
                    ->between(
                        start: Carbon::parse(Research::min('date_submitted')),
                        end: today(),
                    )
                    ->perMonth()
                    ->count();
                break;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Researches',
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
