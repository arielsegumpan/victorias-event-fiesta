<?php

namespace App\Filament\Fiesta\Widgets;

use App\Models\Fiesta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class FiestaStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $userId = Auth::id();

        return [
            Stat::make('Total Fiestas', Fiesta::where('created_by', $userId)->count())
                ->description('All your fiestas')
                ->descriptionIcon('phosphor-calendar-dot')
                ->chart($this->getFiestasTrendData())
                ->color('success'),

            Stat::make('Published Fiestas', Fiesta::where('created_by', $userId)
                    ->where('is_published', true)
                    ->count())
                ->description('Currently visible to public')
                ->descriptionIcon('phosphor-eye')
                ->chart($this->getPublishedTrendData())
                ->color('info'),

            Stat::make('Featured Fiestas', Fiesta::where('created_by', $userId)
                    ->where('is_featured', true)
                    ->count())
                ->description('Highlighted events')
                ->descriptionIcon('phosphor-star')
                ->chart($this->getFeaturedTrendData())
                ->color('warning'),

            Stat::make('Upcoming Fiestas', $this->getUpcomingCount())
                ->description('In the next 30 days')
                ->descriptionIcon('phosphor-clock')
                ->color('primary'),
        ];
    }

    private function getFiestasTrendData(): array
    {
        $userId = Auth::id();
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::where('created_by', $userId)
                ->whereDate('created_at', $date)
                ->count();
        }

        return $data;
    }

    private function getPublishedTrendData(): array
    {
        $userId = Auth::id();
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::where('created_by', $userId)
                ->where('is_published', true)
                ->whereDate('created_at', '<=', $date)
                ->count();
        }

        return $data;
    }

    private function getFeaturedTrendData(): array
    {
        $userId = Auth::id();
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::where('created_by', $userId)
                ->where('is_featured', true)
                ->whereDate('created_at', '<=', $date)
                ->count();
        }

        return $data;
    }

    private function getUpcomingCount(): int
    {
        $userId = Auth::id();

        return Fiesta::where('created_by', $userId)
            ->where('f_start_date', '>=', Carbon::now())
            ->where('f_start_date', '<=', Carbon::now()->addDays(30))
            ->count();
    }
}
