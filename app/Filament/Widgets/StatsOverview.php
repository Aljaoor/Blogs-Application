<?php

namespace App\Filament\Widgets;

use App\Models\Tag;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{

    protected int | string | array $columnSpan = 12;

    protected function getStats(): array
    {
        return [
            Stat::make('Unique views', '102.1k')
                ->description('17k increase this Year')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Average time on page', '4:12')
                ->description('-3% decrease this Year')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([17, 2, 10, 3, 15, 4, 7])
                ->color('danger'),
            Stat::make('Total Tags', Tag::count())
                ->description(Tag::whereDate('created_at','>',Carbon::now()->subYear(1))->count() .' Created this Year')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),

        ];
    }
}
