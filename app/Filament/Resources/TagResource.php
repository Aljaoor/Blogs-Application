<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers;
use App\Models\Tag;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TagResource extends Resource
{
    protected static ?string $model = Tag::class;

    protected static ?string $navigationGroup = "Content";

    protected static ?string $navigationLabel = "Tags Management";

    protected static ?int $navigationSort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-hashtag';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Author')
                    ->options(fn (): array => User::query()->Role('Author')->pluck('name', 'id')->all())
                    ->searchable()
                    ->required(),
//                Forms\Components\Select::make('author_id')
//                    ->relationship('author', 'name', fn (Builder $query) => $query->Role('author'),)
//                    ->getOptionLabelFromRecordUsing(fn (User $record) => "{$record->name} | {$record->roles()->first()->name}")
//                ,
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTags::route('/'),
        ];
    }
}
