<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NumberResource\Pages;
use App\Models\Number;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class NumberResource extends Resource
{
    protected static ?string $model = Number::class;

    protected static ?string $slug = 'numbers';

    protected static ?string $modelLabel = 'number';

    protected static ?string $pluralModelLabel = 'numbers';

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Numbers';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationGroup = 'User Management';

    protected static ?string $navigationParentItem = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('id_number')
                                    ->label('ID Number')
                                    ->placeholder('Enter number')
                                    ->maxLength(255)
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->autofocus(),
                                Forms\Components\Select::make('user_id')
                                    ->label('User')
                                    ->placeholder('Select user')
                                    ->relationship(
                                        name: 'user',
                                        titleAttribute: 'email',
                                        modifyQueryUsing: fn (Builder $query, string $operation, ?Model $record) => $query->when(
                                            $operation === 'create' && ! $record,
                                            fn ($query) => $query
                                                ->whereDoesntHave('number')
                                                ->whereDoesntHave('roles')
                                        )->when(
                                            $operation === 'edit' && ! $record->user,
                                            fn ($query) => $query
                                                ->whereDoesntHave('number')
                                                ->whereDoesntHave('roles')
                                        ),
                                    )
                                    ->searchable()
                                    ->native(false)
                                    ->createOptionForm([
                                        Section::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('first_name')
                                                    ->label('First Name')
                                                    ->placeholder('Enter first name')
                                                    ->maxLength(255)
                                                    ->required()
                                                    ->autofocus(),
                                                Forms\Components\TextInput::make('middle_name')
                                                    ->label('Middle Name')
                                                    ->placeholder('Enter middle name')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('last_name')
                                                    ->label('Last Name')
                                                    ->placeholder('Enter last name')
                                                    ->maxLength(255)
                                                    ->required(),
                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email')
                                                    ->placeholder('Enter email')
                                                    ->email()
                                                    ->maxLength(255)
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                Forms\Components\TextInput::make('password')
                                                    ->label('Password')
                                                    ->placeholder('Enter password')
                                                    ->password()
                                                    ->revealable()
                                                    ->minLength(8)
                                                    ->maxLength(32)
                                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                                    ->required(fn (string $operation): bool => $operation === 'create'),
                                            ])
                                            ->columns(3),
                                    ])
                                    ->editOptionForm([
                                        Section::make()
                                            ->schema([
                                                Forms\Components\TextInput::make('first_name')
                                                    ->label('First Name')
                                                    ->placeholder('Enter first name')
                                                    ->maxLength(255)
                                                    ->required()
                                                    ->autofocus(),
                                                Forms\Components\TextInput::make('middle_name')
                                                    ->label('Middle Name')
                                                    ->placeholder('Enter middle name')
                                                    ->maxLength(255),
                                                Forms\Components\TextInput::make('last_name')
                                                    ->label('Last Name')
                                                    ->placeholder('Enter last name')
                                                    ->maxLength(255)
                                                    ->required(),
                                                Forms\Components\TextInput::make('email')
                                                    ->label('Email')
                                                    ->placeholder('Enter email')
                                                    ->email()
                                                    ->maxLength(255)
                                                    ->required()
                                                    ->unique(ignoreRecord: true),
                                                Forms\Components\TextInput::make('password')
                                                    ->label('Password')
                                                    ->placeholder('Enter password')
                                                    ->password()
                                                    ->revealable()
                                                    ->minLength(8)
                                                    ->maxLength(32)
                                                    ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                                    ->required(fn (string $operation): bool => $operation === 'create'),
                                            ])
                                            ->columns(3),
                                    ]),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_number')
                    ->label('ID Number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('User')
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
                            ->title('Number updated')
                            ->body('A number has been updated successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Number deleted')
                            ->body('A number has been deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    })
                    ->before(function (Tables\Actions\DeleteAction $action, Number $record) {
                        if ($record->user()->exists()) {
                            Notification::make()
                                ->title('Number not deleted')
                                ->body('A number is not allowed to be deleted.')
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
                            ->title('Number force deleted')
                            ->body('A number has been force deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Number restored')
                            ->body('A number has been restored successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('id_number', 'desc')
            ->persistSortInSession()
            ->poll('60s')
            ->deferLoading();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNumbers::route('/'),
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
