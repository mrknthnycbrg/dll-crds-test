<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Post updated')
            ->body('A post has been updated successfully.')
            ->success()
            ->actions([
                Action::make('view')
                    ->label('View Post')
                    ->url(fn (): string => route('filament.admin.resources.posts.view', ['record' => $this->record])),
            ])
            ->sendToDatabase(auth()->user());
    }
}
