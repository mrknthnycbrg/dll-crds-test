<?php

namespace App\Filament\Resources\DepartmentResource\Pages;

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
