<?php

namespace App\Filament\Admin\Resources\BarangayResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\BarangayResource;

class CreateBarangay extends CreateRecord
{
    protected ?int $captainUserId = null;

    protected static string $resource = BarangayResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // $data['created_by'] = $data[''];
    //     dd($data);
    //     return $data;
    // }

    // protected function afterCreate(): void
    // {
    //     // Assign captain after barangay is created
    //     if ($this->captainUserId) {
    //         $this->record->barangayCaptains()->create([
    //             'user_id' => $this->captainUserId,
    //             'term_start' => now(),
    //             'term_end' => null,
    //         ]);
    //     }
    // }

}
