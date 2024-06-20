<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Post added')
            ->body('A post has been added successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View Post')
                    ->url(fn (): string => route('filament.admin.resources.posts.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
