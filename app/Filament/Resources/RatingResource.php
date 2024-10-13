<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RatingResource\Pages;
use App\Filament\Resources\RatingResource\RelationManagers;
use App\Models\Rating;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RatingResource extends Resource
{
    protected static ?string $model = Rating::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $modelLabel = 'Rating';
    protected static ?string $pluralModelLabel = 'Ratings';    
    
    protected static ?string $navigationGroup = 'Website';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->label('Nama'),
                
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->directory('ratings'),
    
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->columnSpanFull(),
    
                Select::make('stars')
                    ->label('Bintang')
                    ->options([
                        1 => '1 Star',
                        2 => '2 Stars',
                        3 => '3 Stars',
                        4 => '4 Stars',
                        5 => '5 Stars',
                    ])
                    ->required()
                    ->default(5),
                Toggle::make('is_displayed')
                ->label('Ditampilkan')
                ->default(true), // Default to true
            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Nama')
                ->sortable()
                ->searchable(),

            ImageColumn::make('image')
                ->label('Gambar')
                ->sortable(),

            TextColumn::make('stars')
                ->label('Bintang')
                ->sortable(),

            IconColumn::make('is_displayed')
                ->boolean()
                ->label('Ditampilkan')
                ->sortable(),
            TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(50)
                ->wrap(),
            ])
            ->filters([
                Filter::make('Displayed')
                ->query(fn (Builder $query): Builder => $query->where('is_displayed', true)),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRatings::route('/'),
            'create' => Pages\CreateRating::route('/create'),
            'edit' => Pages\EditRating::route('/{record}/edit'),
        ];
    }
}
