<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('User updated')
            ->body('A user has been updated successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View User')
                    ->url(fn (): string => route('filament.admin.resources.users.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
