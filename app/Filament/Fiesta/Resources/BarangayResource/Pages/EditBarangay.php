<?php

namespace App\Filament\Fiesta\Resources\BarangayResource\Pages;

use App\Filament\Fiesta\Resources\BarangayResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBarangay extends EditRecord
{
    protected static string $resource = BarangayResource::class;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }

}
