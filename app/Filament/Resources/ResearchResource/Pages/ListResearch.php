<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Exports\ResearchExporter;
use App\Filament\Imports\ResearchImporter;
use App\Filament\Resources\ResearchResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResearch extends ListRecords
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(ResearchExporter::class)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->importer(ResearchImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
