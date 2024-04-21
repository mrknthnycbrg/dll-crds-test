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
                ->label('Export Researches')
                ->exporter(ResearchExporter::class)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Researches')
                ->importer(ResearchImporter::class),
            Actions\CreateAction::make()
                ->label('Add Research'),
        ];
    }
}
