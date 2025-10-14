<?php

namespace App\Filament\Admin\Resources\BarangayCaptainResource\Pages;

use App\Filament\Admin\Resources\BarangayCaptainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBarangayCaptains extends ListRecords
{
    protected static string $resource = BarangayCaptainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('phosphor-plus')->label('New Barangay Captain'),
        ];
    }
}
