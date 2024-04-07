<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Exports\DepartmentExporter;
use App\Filament\Imports\DepartmentImporter;
use App\Filament\Resources\DepartmentResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageDepartments extends ManageRecords
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->exporter(DepartmentExporter::class)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->importer(DepartmentImporter::class),
            Actions\CreateAction::make()
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Department added')
                        ->body('A department has been added successfully.')
                        ->success()
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
