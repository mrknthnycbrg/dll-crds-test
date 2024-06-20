<?php

namespace App\Filament\Resources\DownloadableResource\Pages;

use App\Filament\Resources\DownloadableResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateDownloadable extends CreateRecord
{
    protected static string $resource = DownloadableResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Downloadable added')
            ->body('A downloadable has been added successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View Downloadable')
                    ->url(fn (): string => route('filament.admin.resources.downloadables.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
