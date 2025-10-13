<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Fiesta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class FiestaStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Fiestas', Fiesta::count())
                ->description('All fiestas in the system')
                ->descriptionIcon('heroicon-m-calendar')
                ->chart($this->getFiestasTrendData())
                ->color('success'),

            Stat::make('Published Fiestas', Fiesta::where('is_published', true)->count())
                ->description('Currently visible to public')
                ->descriptionIcon('heroicon-m-eye')
                ->chart($this->getPublishedTrendData())
                ->color('info'),

            Stat::make('Featured Fiestas', Fiesta::where('is_featured', true)->count())
                ->description('Highlighted events')
                ->descriptionIcon('heroicon-m-star')
                ->chart($this->getFeaturedTrendData())
                ->color('warning'),

            Stat::make('Upcoming Fiestas', $this->getUpcomingCount())
                ->description('Starting within 30 days')
                ->descriptionIcon('heroicon-m-clock')
                ->chart($this->getUpcomingTrendData())
                ->color('success'),
        ];
    }

    private function getFiestasTrendData(): array
    {
        // Get fiesta counts for the last 7 days
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::whereDate('created_at', $date)->count();
        }
        return $data;
    }

    private function getPublishedTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::where('is_published', true)
                ->whereDate('created_at', '<=', $date)
                ->count();
        }
        return $data;
    }

    private function getFeaturedTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Fiesta::where('is_featured', true)
                ->whereDate('created_at', '<=', $date)
                ->count();
        }
        return $data;
    }

    private function getUpcomingTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $data[] = Fiesta::where('f_start_date', '>=', $date)
                ->where('f_start_date', '<=', $date->copy()->addDays(30))
                ->count();
        }
        return $data;
    }

    private function getUpcomingCount(): int
    {
        return Fiesta::where('f_start_date', '>=', Carbon::now())
            ->where('f_start_date', '<=', Carbon::now()->addDays(30))
            ->count();
    }
}
