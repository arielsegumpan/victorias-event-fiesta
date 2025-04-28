<?php

namespace App\Filament\Fiesta\Resources\FiestaResource\Pages;

use App\Filament\Fiesta\Resources\FiestaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiestas extends ListRecords
{
    protected static string $resource = FiestaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('heroicon-o-plus')->label('New Fiesta'),
        ];
    }
}
