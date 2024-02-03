<?php

namespace App\Filament\Resources\DownloadableResource\Pages;

use App\Filament\Resources\DownloadableResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDownloadable extends ViewRecord
{
    protected static string $resource = DownloadableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
