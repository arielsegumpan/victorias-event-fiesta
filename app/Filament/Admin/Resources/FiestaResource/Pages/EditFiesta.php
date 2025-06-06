<?php

namespace App\Filament\Admin\Resources\FiestaResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\FiestaResource;

class EditFiesta extends EditRecord
{
    protected static string $resource = FiestaResource::class;

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
        $data['f_name'] = Str::title($data['f_name']);
        $data['f_slug'] = Str::slug($data['f_name']);
        return $data;
    }
}
