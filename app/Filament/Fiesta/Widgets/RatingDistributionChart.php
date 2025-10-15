<?php

namespace App\Filament\Fiesta\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RatingDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Rating Distribution';

    protected static ?string $description = 'Breakdown of ratings for your fiestas';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '250px';

    protected function getData(): array
    {
        $userId = Auth::id();

        // Get rating counts in a single query
        $ratingCounts = Review::whereHas('fiesta', function ($query) use ($userId) {
                $query->where('created_by', $userId);
            })
            ->select('rating', DB::raw('count(*) as count'))
            ->groupBy('rating')
            ->pluck('count', 'rating')
            ->toArray();

        // Fill in missing ratings with 0
        $data = [];
        for ($i = 1; $i <= 5; $i++) {
            $data[] = $ratingCounts[$i] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Number of Reviews',
                    'data' => $data,
                    'backgroundColor' => [
                        'rgb(239, 68, 68)',      // 1 star - red
                        'rgb(251, 146, 60)',      // 2 stars - orange
                        'rgb(250, 204, 21)',      // 3 stars - yellow
                        'rgb(132, 204, 22)',      // 4 stars - lime
                        'rgb(34, 197, 94)',       // 5 stars - green
                    ],
                ],
            ],
            'labels' => ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
            'maxBarThickness' => 15,
            'borderRadius' => 30
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
