<?php

namespace App\Filament\Fiesta\Widgets;

use Filament\Tables;
use App\Models\Fiesta;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\TableWidget as BaseWidget;

class TopRatedFiestasWidget extends BaseWidget
{
   protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 4;
    protected static ?string $heading = 'Top Rated Fiestas';

    public function table(Table $table): Table
    {
        $user = Auth::user();
        $barangayId = $user->currentBarangay?->barangay_id;

        $query = Fiesta::query()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->limit(5);

        // Filter by barangay if assigned
        if ($barangayId) {
            $query->where('barangay_id', $barangayId);
        } else {
            // If no barangay assigned, return empty query
            $query->whereRaw('1 = 0');
        }

        return $table
            ->query($query)
            ->columns([
                 Tables\Columns\TextColumn::make('f_name')
                    ->label('Fiesta Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('reviews_avg_rating')
                    ->label('Rating')
                    ->formatStateUsing(function ($state) {
                        $stars = str_repeat('⭐', (int) round($state));
                        return number_format($state, 2) . ' ' . $stars;
                    })
                    ->sortable()
                    ->alignCenter()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('reviews_count')
                    ->label('Reviews')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color(fn ($state) => match(true) {
                        $state >= 50 => 'success',
                        $state >= 20 => 'warning',
                        default => 'info',
                    }),

                Tables\Columns\TextColumn::make('barangay.brgy_name')
                    ->label('Barangay')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean()
                    ->toggleable(),
            ])
            ->defaultSort('reviews_avg_rating', 'desc')
            ->emptyStateHeading($barangayId ? 'No rated fiestas yet' : 'No barangay assigned')
            ->emptyStateDescription($barangayId
                ? 'Fiestas in your barangay will appear here once they receive reviews.'
                : 'You need to be assigned to a barangay to view this data.'
            )
            ->emptyStateIcon('phosphor-star')
            ->striped();
    }
}
