<?php

namespace App\Filament\Admin\Resources\FiestaResource\Pages;

use App\Filament\Admin\Resources\FiestaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFiestas extends ListRecords
{
    protected static string $resource = FiestaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->icon('phosphor-plus')->label('New Fiesta'),
        ];
    }
}
