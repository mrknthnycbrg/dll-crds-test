<?php

namespace App\Filament\Resources\AuthorResource\Pages;

use App\Filament\Resources\AuthorResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;

class ManageAuthors extends ManageRecords
{
    protected static string $resource = AuthorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add Author')
                ->successNotification(null)
                ->after(function () {
                    Notification::make()
                        ->title('Author added')
                        ->body('An author has been added successfully.')
                        ->success()
                        ->actions([
                            Action::make('view')
                                ->label('Go to Authors')
                                ->url(fn (): string => route('filament.admin.resources.authors.index')),
                        ])
                        ->send()
                        ->sendToDatabase(auth()->user());
                }),
        ];
    }
}
