<?php

namespace App\Filament\Admin\Resources\BarangayResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\BarangayResource;

class CreateBarangay extends CreateRecord
{
    protected static string $resource = BarangayResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['brgy_name'] = Str::title($data['brgy_name']);
        $data['brgy_slug'] = Str::slug($data['brgy_slug']);
        return $data;
    }
}
