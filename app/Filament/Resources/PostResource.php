<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\Widgets\BlogPostsChart;
use App\Models\Post;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationGroup = "Content";

    protected static ?string $navigationLabel = "Posts Management";

    protected static ?int $navigationSort = 4;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereDate('created_at' ,'>',Carbon::now()->subDay(2))->count() > 0 ? 'new' : '';
    }
    protected static ?string $navigationBadgeTooltip = 'The number of users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Forms\Set $set, ?string $state) {
                                $set('slug', \Str::slug($state));
                            })
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('category_id')
                            ->relationship('categories', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('tag_id')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->required(),
                        Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name', fn(Builder $query) => $query->Role('Author'))
                            ->required(),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->required(),

                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\FileUpload::make('image')
                                    ->image()
                                    ->required(),
                            ])
                        ,
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('meta_title')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('meta_description')
                            ->maxLength(255),

                        Forms\Components\Toggle::make('active')
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->limit(20)
                    ->searchable(),
                Tables\Columns\TextColumn::make('categories.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tags.name')
                    ->searchable()
                    ->limit(20),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime('Y-m-d')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('Y-m-d')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->after(function (Post $record) {
                            if ($record->image) {
                                \Storage::disk('public')->delete($record->image);
                            }
                        }),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\CategoriesRelationManager::class,
            RelationManagers\TagsRelationManager::class
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

}
