<?php

namespace App\Filament\Admin\Resources\BarangayResource\Pages;

use App\Filament\Admin\Resources\BarangayResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangays extends ListRecords
{
    protected static string $resource = BarangayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('phosphor-plus')->label('New Barangay'),
        ];
    }
}
