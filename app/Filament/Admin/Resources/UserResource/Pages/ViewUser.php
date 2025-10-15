<?php

namespace App\Filament\Admin\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Str;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;
use App\Filament\Admin\Resources\UserResource;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $recordTitleAttribute = 'name';

    public function getTitle(): string | Htmlable
    {
        /** @var User */
        $record = $this->getRecord();
        return Str::ucwords($record->name);
    }

    protected function getActions(): array
    {
        return [];
    }
}
