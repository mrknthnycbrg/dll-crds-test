<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DownloadableResource\Pages;
use App\Models\Downloadable;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DownloadableResource extends Resource
{
    protected static ?string $model = Downloadable::class;

    protected static ?string $slug = 'downloadables';

    protected static ?string $modelLabel = 'downloadable';

    protected static ?string $pluralModelLabel = 'downloadables';

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationLabel = 'Downloadables';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Content Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Title')
                                    ->placeholder('Enter title')
                                    ->maxLength(255)
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->autofocus(),
                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->unique(ignoreRecord: true),
                                Forms\Components\RichEditor::make('description')
                                    ->label('Description')
                                    ->placeholder('Enter description')
                                    ->required()
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('file_path')
                                    ->label('File')
                                    ->required()
                                    ->openable()
                                    ->downloadable()
                                    ->disk('public')
                                    ->directory('downloadable-files'),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('published')
                                    ->label('Published')
                                    ->required()
                                    ->default(true),
                                Forms\Components\DatePicker::make('date_published')
                                    ->label('Date Published')
                                    ->required()
                                    ->default(now())
                                    ->maxDate(now())
                                    ->format('Y-m-d')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                                Forms\Components\Select::make('author_id')
                                    ->label('Author')
                                    ->placeholder('Select author')
                                    ->required()
                                    ->relationship(
                                        name: 'author',
                                        titleAttribute: 'name'
                                    )
                                    ->searchable()
                                    ->preload()
                                    ->native(false)
                                    ->createOptionForm([
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
                                    ->editOptionForm([
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
                                    ]),
                            ]),
                    ])
                    ->columnSpan(1),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ToggleColumn::make('published')
                    ->label('Published'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_published')
                    ->label('Date Published')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Filters\Filter::make('date_published')
                    ->form([
                        DatePicker::make('published_from')
                            ->label('Published From')
                            ->maxDate(now())
                            ->native(false)
                            ->closeOnDateSelection(),
                        DatePicker::make('published_until')
                            ->label('Published Until')
                            ->maxDate(now())
                            ->native(false)
                            ->closeOnDateSelection(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['published_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_published', '>=', $date),
                            )
                            ->when(
                                $data['published_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('date_published', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];

                        if ($data['published_from'] ?? null) {
                            $indicators[] = Indicator::make('Published from '.Carbon::parse($data['published_from'])->toFormattedDateString())
                                ->removeField('published_from');
                        }

                        if ($data['published_until'] ?? null) {
                            $indicators[] = Indicator::make('Published until '.Carbon::parse($data['published_until'])->toFormattedDateString())
                                ->removeField('published_until');
                        }

                        return $indicators;
                    }),
                Tables\Filters\SelectFilter::make('author')
                    ->label('Author')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Published')
                    ->placeholder('All downloadables')
                    ->trueLabel('Published downloadables')
                    ->falseLabel('Unpublished downloadables')
                    ->native(false),
                Tables\Filters\TrashedFilter::make()
                    ->label('Deleted Records')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Downloadable deleted')
                            ->body('A downloadable has been deleted successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Downloadables')
                                    ->url(fn (): string => route('filament.admin.resources.downloadables.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Downloadable force deleted')
                            ->body('A downloadable has been force deleted successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Downloadables')
                                    ->url(fn (): string => route('filament.admin.resources.downloadables.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Downloadable restored')
                            ->body('A downloadable has been restored successfully.')
                            ->success()
                            ->actions([
                                Action::make('view')
                                    ->label('Go to Downloadables')
                                    ->url(fn (): string => route('filament.admin.resources.downloadables.index')),
                            ])
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('date_published', 'desc')
            ->persistSortInSession()
            ->poll('60s')
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDownloadables::route('/'),
            'create' => Pages\CreateDownloadable::route('/create'),
            'view' => Pages\ViewDownloadable::route('/{record}'),
            'edit' => Pages\EditDownloadable::route('/{record}/edit'),
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
