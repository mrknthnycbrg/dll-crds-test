<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Indicator;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $slug = 'posts';

    protected static ?string $modelLabel = 'post';

    protected static ?string $pluralModelLabel = 'posts';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Posts';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Post Management';

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
                                Forms\Components\RichEditor::make('content')
                                    ->label('Content')
                                    ->placeholder('Enter content')
                                    ->required()
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        Section::make()
                            ->schema([
                                Forms\Components\FileUpload::make('image_path')
                                    ->label('Image')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        null,
                                        '16:9',
                                        '4:3',
                                        '1:1',
                                    ])
                                    ->openable()
                                    ->downloadable()
                                    ->disk('public')
                                    ->directory('post-images'),
                            ]),
                    ])
                    ->columnSpan(2),

                Forms\Components\Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\Toggle::make('published')
                                    ->label('Published')
                                    ->default(false),
                                Forms\Components\DatePicker::make('date_published')
                                    ->label('Date Published')
                                    ->default(now())
                                    ->maxDate(now())
                                    ->format('Y-m-d')
                                    ->native(false)
                                    ->closeOnDateSelection(),
                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->placeholder('Select category')
                                    ->relationship(
                                        name: 'category',
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
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                                    ->autofocus(),
                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Slug')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->unique(ignoreRecord: true),
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
                                                    ->live(onBlur: true)
                                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                                    ->autofocus(),
                                                Forms\Components\TextInput::make('slug')
                                                    ->label('Slug')
                                                    ->disabled()
                                                    ->dehydrated()
                                                    ->unique(ignoreRecord: true),
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
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Tables\Filters\TernaryFilter::make('published')
                    ->label('Published')
                    ->placeholder('All posts')
                    ->trueLabel('Published posts')
                    ->falseLabel('Unpublished posts')
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
                            ->title('Post deleted')
                            ->body('A post has been deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\ForceDeleteAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Post force deleted')
                            ->body('A post has been force deleted successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
                Tables\Actions\RestoreAction::make()
                    ->successNotification(null)
                    ->after(function () {
                        Notification::make()
                            ->title('Post restored')
                            ->body('A post has been restored successfully.')
                            ->success()
                            ->send()
                            ->sendToDatabase(auth()->user());
                    }),
            ])
            ->bulkActions([])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->defaultSort('date_published', 'desc')
            ->persistSortInSession();
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
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
