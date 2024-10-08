<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdviserResource\Pages;
use App\Models\Adviser;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdviserResource extends Resource
{
    protected static ?string $model = Adviser::class;

    protected static ?string $slug = 'advisers';

    protected static ?string $modelLabel = 'adviser';

    protected static ?string $pluralModelLabel = 'advisers';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationLabel = 'Advisers';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Research Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Name')
                                    ->placeholder('Enter name')
                                    ->maxLength(255)
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->autofocus(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->label('Deleted At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->label('Deleted Records')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Adviser updated')
                            ->body('An adviser has been updated successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Advisers')
                                    ->url(fn (): string => route('filament.admin.resources.advisers.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Adviser deleted')
                            ->body('An adviser has been deleted successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Advisers')
                                    ->url(fn (): string => route('filament.admin.resources.advisers.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    })
                    ->before(function (Tables\Actions\DeleteAction $action, Adviser $record) {
                        if ($record->researches()->exists()) {
                            Notification::make()
                                ->title('Adviser not deleted')
                                ->body('An adviser is not allowed to be deleted.')
                                ->danger()
                                ->actions([
                                    Action::make('view')
                                        ->label('Go to Advisers')
                                        ->url(fn (): string => route('filament.admin.resources.advisers.index')),
                                ])
                                ->send()
                                ->sendToDatabase(auth()->user());

                            $action->cancel();
                        }
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Adviser force deleted')
                            ->body('An adviser has been force deleted successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Advisers')
                                    ->url(fn (): string => route('filament.admin.resources.advisers.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Adviser restored')
                            ->body('An adviser has been restored successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Advisers')
                                    ->url(fn (): string => route('filament.admin.resources.advisers.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('name', 'asc')
            ->persistSortInSession()
            ->poll('60s')
            ->deferLoading();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAdvisers::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
