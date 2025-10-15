<?php

namespace App\Filament\Fiesta\Resources\BarangayResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Fiesta\Resources\BarangayResource;

class ViewBarangay extends ViewRecord
{
    protected static string $resource = BarangayResource::class;

    protected static ?string $recordTitleAttribute = 'brgy_name';

    public function getTitle(): string | Htmlable
    {
        /** @var Barangay */
        $record = $this->getRecord();
        return Str::ucwords($record->brgy_name);
    }

    protected function getActions(): array
    {
        return [];
    }
}
