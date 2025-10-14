<?php

namespace App\Filament\Admin\Resources\BarangayCaptainResource\Pages;

use App\Filament\Admin\Resources\BarangayCaptainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangayCaptain extends EditRecord
{
    protected static string $resource = BarangayCaptainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
