<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Category added')
                        ->body('A category has been added successfully.')
                        ->success()
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
