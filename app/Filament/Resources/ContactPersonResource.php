<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactPersonResource\Pages;
use App\Filament\Resources\ContactPersonResource\RelationManagers;
use App\Models\ContactPerson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactPersonResource extends Resource
{
    protected static ?string $model = ContactPerson::class;

    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Contact Persons';
    protected static ?string $label = 'Contact Person';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $pluralLabel = 'Contact Persons';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Select::make('role')->label('Role')
                    ->options([
                        'beranda' => 'Beranda',
                        'transaksi' => 'Transaksi',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('number')
                    ->required()
                    ->maxLength(15),
            ])
            ->columns(1);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('role')->sortable(),
                Tables\Columns\TextColumn::make('number')->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListContactPeople::route('/'),
            'create' => Pages\CreateContactPerson::route('/create'),
            'edit' => Pages\EditContactPerson::route('/{record}/edit'),
        ];
    }
    
    
}
