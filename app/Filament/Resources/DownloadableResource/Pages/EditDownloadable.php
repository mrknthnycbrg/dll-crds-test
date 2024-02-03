<?php

namespace App\Filament\Resources\DownloadableResource\Pages;

use App\Filament\Resources\DownloadableResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditDownloadable extends EditRecord
{
    protected static string $resource = DownloadableResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Downloadable updated')
            ->body('A downloadable has been updated successfully.')
            ->success()
            ->sendToDatabase(auth()->user());
    }
}
