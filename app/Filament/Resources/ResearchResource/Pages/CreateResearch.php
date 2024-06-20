<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Notifications\Actions\Action;
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
            ->actions([
                Action::make('view')
                    ->label('View Research')
                    ->url(fn (): string => route('filament.admin.resources.researches.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
