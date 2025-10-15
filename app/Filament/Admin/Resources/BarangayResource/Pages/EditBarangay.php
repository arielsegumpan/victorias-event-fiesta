<?php

namespace App\Filament\Admin\Resources\BarangayResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\BarangayResource;

class EditBarangay extends EditRecord
{
    protected ?int $captainUserId = null;

    protected static string $resource = BarangayResource::class;

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


    protected function mutateFormDataBeforeSave(array $data): array
    {
        // // Store captain ID separately
        // $this->captainUserId = $data['current_captain_user_id'] ?? null;
        // unset($data['current_captain_user_id']);


        $data['brgy_name'] = Str::title($data['brgy_name']);
        $data['brgy_slug'] = Str::slug($data['brgy_slug']);

        return $data;
    }

    protected function afterSave(): void
    {
        if ($this->captainUserId) {
            // Check if this user is already the current captain
            $currentCaptain = $this->record->currentCaptain;

            if (!$currentCaptain || $currentCaptain->user_id != $this->captainUserId) {
                // End current captain's term if exists
                if ($currentCaptain) {
                    $currentCaptain->update(['term_end' => now()->subDay()]);
                }

                // Create new captain assignment
                $this->record->barangayCaptains()->create([
                    'user_id' => $this->captainUserId,
                    'term_start' => now(),
                    'term_end' => null,
                ]);
            }
        }
    }
}
