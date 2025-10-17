<?php

namespace App\Filament\Admin\Resources\ContactResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Admin\Resources\ContactResource;

class EditContact extends EditRecord
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->icon('phosphor-trash'),
        ];
    }

    protected static ?string $recordTitleAttribute = 'f_name';

    public function getTitle(): string | Htmlable
    {
        /** @var Contact */
        $record = $this->getRecord();
        return Str::ucwords($record->name);
    }

    protected function getActions(): array
    {
        return [];
    }


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }
}
