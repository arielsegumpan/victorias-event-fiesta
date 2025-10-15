<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Filament\Admin\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['barangay_id'], $data['term_start'], $data['term_end']);
        return $data;
    }

    protected function afterCreate(): void
    {
        $data = $this->form->getState();

        if (isset($data['barangay_id']) && !empty($data['barangay_id'])) {
            $this->record->captainOf()->create([
                'barangay_id' => $data['barangay_id'],
                'term_start' => $data['term_start'],
                'term_end' => $data['term_end'] ?? null,
            ]);
        }
    }
}
