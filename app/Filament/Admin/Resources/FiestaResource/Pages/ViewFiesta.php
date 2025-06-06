<?php

namespace App\Filament\Admin\Resources\FiestaResource\Pages;

use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Admin\Resources\FiestaResource;

class ViewFiesta extends ViewRecord
{
    protected static string $resource = FiestaResource::class;

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

}
