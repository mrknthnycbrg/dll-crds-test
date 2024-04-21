<?php

namespace App\Filament\Resources\AdviserResource\Pages;

use App\Filament\Exports\AdviserExporter;
use App\Filament\Imports\AdviserImporter;
use App\Filament\Resources\AdviserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageAdvisers extends ManageRecords
{
    protected static string $resource = AdviserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export Advisers')
                ->exporter(AdviserExporter::class)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Advisers')
                ->importer(AdviserImporter::class),
            Actions\CreateAction::make()
                ->label('Add Adviser')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Adviser added')
                        ->body('An adviser has been added successfully.')
                        ->success()
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
