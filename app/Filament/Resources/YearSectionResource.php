<?php

namespace App\Filament\Resources;

use App\Filament\Resources\YearSectionResource\Pages;
use App\Models\YearSection;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class YearSectionResource extends Resource
{
    protected static ?string $model = YearSection::class;

    protected static ?string $slug = 'sections';

    protected static ?string $modelLabel = 'section';

    protected static ?string $pluralModelLabel = 'sections';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationLabel = 'Sections';

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationGroup = 'Research Management';

    protected static ?string $navigationParentItem = 'Researches';

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
                            ->title('Section updated')
                            ->body('A section has been updated successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Section deleted')
                            ->body('A section has been deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    })
                    ->before(function (Tables\Actions\DeleteAction $action, YearSection $record) {
                        if ($record->researches()->exists()) {
                            Notification::make()
                                ->title('Section not deleted')
                                ->body('A section is not allowed to be deleted.')
                                ->danger()
                                ->send()
                                ->sendToDatabase(auth()->user());

                            $action->cancel();
                        }
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Section force deleted')
                            ->body('A section has been force deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Section restored')
                            ->body('A section has been restored successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('name', 'asc')
            ->persistSortInSession();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageYearSections::route('/'),
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
