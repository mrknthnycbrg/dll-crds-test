<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateResearch extends CreateRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Research added')
            ->body('A research has been added successfully.')
            ->success()
            ->sendToDatabase(auth()->user());
    }
}
