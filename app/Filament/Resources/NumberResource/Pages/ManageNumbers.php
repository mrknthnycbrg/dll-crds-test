<?php

namespace App\Filament\Resources\NumberResource\Pages;

use App\Filament\Exports\NumberExporter;
use App\Filament\Imports\NumberImporter;
use App\Filament\Resources\NumberResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageNumbers extends ManageRecords
{
    protected static string $resource = NumberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export Numbers')
                ->exporter(NumberExporter::class)
                ->chunkSize(25)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Numbers')
                ->importer(NumberImporter::class)
                ->chunkSize(25),
            Actions\CreateAction::make()
                ->label('Add Number')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Number added')
                        ->body('A number has been added successfully.')
                        ->success()
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
