<?php

namespace App\Filament\Widgets;

use App\Models\Downloadable;
use App\Models\Post;
use App\Models\Research;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;

    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Researches', Research::count()),
            Stat::make('Total Posts', Post::count()),
            Stat::make('Total Downloadables', Downloadable::count()),
            Stat::make('Total Users', User::count()),
        ];
    }
}
