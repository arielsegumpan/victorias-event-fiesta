<?php

namespace App\Filament\Fiesta\Resources\FiestaResource\Pages;

use App\Filament\Fiesta\Resources\FiestaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFiesta extends EditRecord
{
    protected static string $resource = FiestaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
