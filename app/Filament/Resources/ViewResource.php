<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ViewResource\Pages;
use App\Models\View;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ViewResource extends Resource
{
    protected static ?string $model = View::class;

    protected static ?string $slug = 'views';

    protected static ?string $modelLabel = 'view';

    protected static ?string $pluralModelLabel = 'views';

    protected static ?string $navigationIcon = 'heroicon-o-eye';

    protected static ?string $navigationLabel = 'Views';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Research Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('user_email')
                                    ->label('Email')
                                    ->placeholder('Enter email')
                                    ->email()
                                    ->maxLength(255)
                                    ->required()
                                    ->autofocus(),
                                Forms\Components\TextInput::make('research_title')
                                    ->label('Title')
                                    ->placeholder('Enter title')
                                    ->maxLength(255)
                                    ->required(),
                                Forms\Components\DateTimePicker::make('date_viewed')
                                    ->label('Date Viewed')
                                    ->default(now())
                                    ->maxDate(now())
                                    ->native(false)
                                    ->closeOnDateSelection(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_email')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('research_title')
                    ->label('Research')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_viewed')
                    ->label('Date Viewed')
                    ->dateTime()
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
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('View deleted')
                            ->body('A view has been deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('View force deleted')
                            ->body('A view has been force deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('View restored')
                            ->body('A view has been restored successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([])
            ->defaultSort('date_viewed', 'desc')
            ->persistSortInSession();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageViews::route('/'),
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
