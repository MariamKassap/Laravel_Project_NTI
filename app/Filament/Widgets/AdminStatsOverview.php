<?php

namespace App\Filament\Widgets;

use App\Models\Application;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count()),
            Stat::make('Jobs', Job::count()),
            Stat::make('Applications', Application::count()),
            Stat::make('Posts', Post::count()),
        ];
    }
}
