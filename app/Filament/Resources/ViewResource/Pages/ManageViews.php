<?php

namespace App\Filament\Resources\ViewResource\Pages;

use App\Filament\Resources\ViewResource;
use Filament\Resources\Pages\ManageRecords;

class ManageViews extends ManageRecords
{
    protected static string $resource = ViewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
