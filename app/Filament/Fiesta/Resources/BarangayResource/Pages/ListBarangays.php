<?php

namespace App\Filament\Fiesta\Resources\BarangayResource\Pages;

use App\Filament\Fiesta\Resources\BarangayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangays extends ListRecords
{
    protected static string $resource = BarangayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-plus')->label('New Barangay'),
        ];
    }
}
