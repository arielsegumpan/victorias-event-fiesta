<?php

namespace App\Filament\Admin\Resources\BarangayCaptainResource\Pages;

use App\Filament\Admin\Resources\BarangayCaptainResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBarangayCaptain extends CreateRecord
{
    protected static string $resource = BarangayCaptainResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
