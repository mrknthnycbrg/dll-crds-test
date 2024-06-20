<?php

namespace App\Filament\Resources\ResearchResource\Pages;

use App\Filament\Resources\ResearchResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditResearch extends EditRecord
{
    protected static string $resource = ResearchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Research updated')
            ->body('A research has been updated successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View Research')
                    ->url(fn (): string => route('filament.admin.resources.researches.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
