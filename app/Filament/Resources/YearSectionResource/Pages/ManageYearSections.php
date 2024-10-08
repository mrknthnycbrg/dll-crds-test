<?php

namespace App\Filament\Resources\YearSectionResource\Pages;

use App\Filament\Exports\YearSectionExporter;
use App\Filament\Imports\YearSectionImporter;
use App\Filament\Resources\YearSectionResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
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
                ->chunkSize(25)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Sections')
                ->importer(YearSectionImporter::class)
                ->maxRows(100)
                ->chunkSize(25),
            Actions\CreateAction::make()
                ->label('Add Section')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Section added')
                        ->body('A section has been added successfully.')
                        ->success()
                        ->actions([
                            Action::make('view')
                                ->label('Go to Sections')
                                ->url(fn (): string => route('filament.admin.resources.sections.index')),
                        ])
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
