<?php

namespace App\Filament\Fiesta\Resources\FiestaResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Fiesta\Resources\FiestaResource;

class CreateFiesta extends CreateRecord
{
    protected static string $resource = FiestaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['f_name'] = Str::title($data['f_name']);
        $data['f_slug'] = Str::slug($data['f_name']);
        $data['created_by'] = auth()->id();
        $data['is_published'] = false;

        $currentCaptainRole = auth()->user()->currentBarangay()->first();

        if ($currentCaptainRole) {
            $data['barangay_id'] = $currentCaptainRole->barangay_id;
        }

        return $data;
    }
}
