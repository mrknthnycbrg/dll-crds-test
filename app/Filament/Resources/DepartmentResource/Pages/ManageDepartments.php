<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

use App\Filament\Exports\DepartmentExporter;
use App\Filament\Imports\DepartmentImporter;
use App\Filament\Resources\DepartmentResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageDepartments extends ManageRecords
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ExportAction::make()
                ->label('Export Departments')
                ->exporter(DepartmentExporter::class)
                ->chunkSize(25)
                ->columnMapping(false),
            Actions\ImportAction::make()
                ->label('Import Departments')
                ->importer(DepartmentImporter::class)
                ->maxRows(100)
                ->chunkSize(25),
            Actions\CreateAction::make()
                ->label('Add Department')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Department added')
                        ->body('A department has been added successfully.')
                        ->success()
                        ->actions([
                            Action::make('view')
                                ->label('Go to Departments')
                                ->url(fn (): string => route('filament.admin.resources.departments.index')),
                        ])
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
