<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Review;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class ReviewStatsOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Reviews', Review::count())
                ->description('All reviews submitted')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->chart($this->getReviewsTrendData())
                ->color('success'),

            Stat::make('Pending Reviews', Review::where('is_approved', false)->count())
                ->description('Awaiting moderation')
                ->descriptionIcon('heroicon-m-clock')
                ->chart($this->getPendingTrendData())
                ->color('warning'),

            Stat::make('Average Rating', number_format($this->getAverageRating(), 1))
                ->description('Overall satisfaction')
                ->descriptionIcon('heroicon-m-star')
                ->chart($this->getAverageRatingTrendData())
                ->color('info'),

            Stat::make('Reviews Today', $this->getTodayReviewsCount())
                ->description('Submitted in last 24h')
                ->descriptionIcon('heroicon-m-calendar')
                ->chart($this->getDailyReviewsData())
                ->color('success'),
        ];
    }

    private function getReviewsTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Review::whereDate('created_at', $date)->count();
        }
        return $data;
    }

    private function getPendingTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Review::where('is_approved', false)
                ->whereDate('created_at', '<=', $date)
                ->count();
        }
        return $data;
    }

    private function getAverageRating(): float
    {
        return Review::where('is_approved', true)->avg('rating') ?? 0;
    }

    private function getAverageRatingTrendData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $avg = Review::where('is_approved', true)
                ->whereDate('created_at', '<=', $date)
                ->avg('rating') ?? 0;
            $data[] = round($avg, 1);
        }
        return $data;
    }

    private function getTodayReviewsCount(): int
    {
        return Review::whereDate('created_at', Carbon::today())->count();
    }

    private function getDailyReviewsData(): array
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->startOfDay();
            $data[] = Review::whereDate('created_at', $date)->count();
        }
        return $data;
    }
}
