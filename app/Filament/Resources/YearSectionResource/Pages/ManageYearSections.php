<?php

namespace App\Filament\Resources\YearSectionResource\Pages;

use App\Filament\Exports\YearSectionExporter;
use App\Filament\Imports\YearSectionImporter;
use App\Filament\Resources\YearSectionResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageYearSections extends ManageRecords
{
    protected static string $resource = YearSectionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export Sections')
                ->exporter(YearSectionExporter::class)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Sections')
                ->importer(YearSectionImporter::class),
            Actions\CreateAction::make()
                ->label('Add Section')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Section added')
                        ->body('A section has been added successfully.')
                        ->success()
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
