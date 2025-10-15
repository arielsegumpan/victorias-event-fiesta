<?php

namespace App\Filament\Admin\Resources\FiestaResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Admin\Resources\FiestaResource;

class EditFiesta extends EditRecord
{
    protected static string $resource = FiestaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->icon('phosphor-trash'),
        ];
    }

    protected static ?string $recordTitleAttribute = 'f_name';

    public function getTitle(): string | Htmlable
    {
        /** @var Fiesta */
        $record = $this->getRecord();
        return Str::ucwords($record->f_name);
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
        $data['f_name'] = Str::title($data['f_name']);
        $data['f_slug'] = Str::slug($data['f_name']);
        $data['is_published'] = $data['is_published'];


        // dd($data);
        return $data;
    }
}
