<?php

namespace App\Filament\Fiesta\Resources\FiestaResource\Pages;

use App\Filament\Fiesta\Resources\FiestaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFiesta extends CreateRecord
{
    protected static string $resource = FiestaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
