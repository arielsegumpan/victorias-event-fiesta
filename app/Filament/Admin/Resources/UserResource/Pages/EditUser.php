<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use Filament\Actions;
use App\Models\BarangayCaptain;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\UserResource;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->icon('phosphor-trash'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load barangay captain data if exists
        if ($this->record->currentBarangay) {
            $data['barangay_id'] = $this->record->currentBarangay->barangay_id;
            $data['term_start'] = $this->record->currentBarangay->term_start;
            $data['term_end'] = $this->record->currentBarangay->term_end;
        }

        return $data;
    }

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     unset($data['barangay_id'], $data['term_start'], $data['term_end']);
    //     return $data;
    // }

    protected function afterSave(): void
    {
        $data = $this->form->getState();

        // Only handle barangay captain assignment if barangay_id is set
        if (isset($data['barangay_id']) && !empty($data['barangay_id'])) {
            $existingCaptain = $this->record->currentBarangay;

            if ($existingCaptain) {
                // Update existing assignment
                $existingCaptain->update([
                    'barangay_id' => $data['barangay_id'],
                    'term_start' => $data['term_start'],
                    'term_end' => $data['term_end'] ?? null,
                ]);
            } else {
                // Create new assignment
                $this->record->captainOf()->create([
                    'barangay_id' => $data['barangay_id'],
                    'term_start' => $data['term_start'],
                    'term_end' => $data['term_end'] ?? null,
                ]);
            }
        }
    }
}
