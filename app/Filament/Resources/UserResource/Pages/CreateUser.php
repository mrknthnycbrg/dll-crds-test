<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('User added')
            ->body('A user has been added successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View User')
                    ->url(fn (): string => route('filament.admin.resources.users.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
