<?php

namespace App\Filament\Fiesta\Resources\BarangayResource\Pages;

use App\Filament\Fiesta\Resources\BarangayResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBarangay extends CreateRecord
{
    protected static string $resource = BarangayResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
