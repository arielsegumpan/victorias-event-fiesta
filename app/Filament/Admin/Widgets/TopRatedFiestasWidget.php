<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Fiesta;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TopRatedFiestasWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Top Rated Fiestas';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Fiesta::query()
                    ->withCount('reviews')
                    ->withAvg('reviews', 'rating')
                    ->having('reviews_count', '>', 0)
                    ->orderByDesc('reviews_avg_rating')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('f_name')
                    ->label('Fiesta Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('reviews_avg_rating')
                    ->label('Average Rating')
                    ->formatStateUsing(fn ($state) => number_format($state, 2) . ' ⭐')
                    ->sortable(),

                Tables\Columns\TextColumn::make('reviews_count')
                    ->label('Total Reviews')
                    ->sortable(),

                Tables\Columns\TextColumn::make('barangay.name')
                    ->label('Barangay')
                    ->searchable(),
            ])
            ->defaultSort('reviews_avg_rating', 'desc');
    }
}
