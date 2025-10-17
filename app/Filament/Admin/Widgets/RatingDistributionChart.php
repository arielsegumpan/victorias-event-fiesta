<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Review;
use Filament\Widgets\ChartWidget;

class RatingDistributionChart extends ChartWidget
{
    protected static ?string $heading = 'Rating Distribution';

    protected static ?string $description = 'Breakdown of all ratings';
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 3;
    protected static ?string $maxHeight = '250px';


    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Number of Reviews',
                    'data' => [
                        Review::where('rating', 1)->count(),
                        Review::where('rating', 2)->count(),
                        Review::where('rating', 3)->count(),
                        Review::where('rating', 4)->count(),
                        Review::where('rating', 5)->count(),
                    ],
                    'backgroundColor' => [
                        'rgb(239, 68, 68)',
                        'rgb(251, 146, 60)',
                        'rgb(250, 204, 21)',
                        'rgb(132, 204, 22)',
                        'rgb(34, 197, 94)',
                    ],
                    'borderRadius' => 150,
                    'borderWidth' => 0,
                    'maxBarThickness' => 30
                ],
            ],
            'labels' => ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
