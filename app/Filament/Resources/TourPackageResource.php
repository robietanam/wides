<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TourPackage;
use Filament\Resources\Resource;
use App\Filament\Resources\TourPackageResource\Pages;

class TourPackageResource extends Resource
{
    protected static ?string $model = TourPackage::class;
    protected static ?string $navigationIcon = 'heroicon-o-ticket';
    protected static ?string $navigationLabel = 'Paket Layanan';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $pluralModelLabel = 'Paket Layanan';
    protected static ?string $slug = 'paket-liburan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Buat Paket Layanan')
                    ->schema([
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Paket')
                                    ->required()
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('price')
                                    ->label('Harga')
                                    ->numeric()
                                    ->prefix('IDR')
                                    ->maxValue(42949672.95),
                                Forms\Components\MarkdownEditor::make('description')
                                    ->label('Deskripsi')
                                    ->maxLength(65535)
                                    ->columnSpan('full'),
                                Forms\Components\Select::make('services')
                                    ->label('Fitur  Layanan')
                                    ->relationship('services', 'name') 
                                    ->multiple()
                                    ->preload()
                                    ->createOptionForm([
                                        Forms\Components\TextInput::make('name')
                                            ->label('Nama Layanan')
                                            ->required(),
                                    ])
                            ])->columns(2),
                        Forms\Components\Section::make('Status')
                            ->schema([
                                Forms\Components\Toggle::make('is_visible')
                                    ->label('Dilihat oleh Wisatawan'),
                            ]),
                        Forms\Components\Section::make('Media')
                            ->schema([
                                Forms\Components\FileUpload::make('image_icon')
                                ->label('Thumbnail')
                                ->image()
                                // ->imagePreview()
                                ->disk('public')
                                ->directory('background')
                                ->required()
                                ->columnSpan('full'),
                                Forms\Components\Repeater::make('images')
                                ->relationship('images')
                                ->label('Galeri')
                                ->schema([
                                    Forms\Components\FileUpload::make('image_url')
                                        ->image()
                                        ->required(),
                                ]),
                                Forms\Components\Repeater::make('videos')
                                    ->relationship('videos')
                                    ->label('Video Galeri')
                                    ->schema([
                                        Forms\Components\TextInput::make('video_url')
                                            ->label('Link Video Youtube')
                                            ->required(),
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul')
                                            ->required(),
                                        Forms\Components\Textarea::make('description')
                                            ->label('Deskripsi')
                                            ->required(),
                                ]),
                            ]),
                        
                        
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit('50'),

                Tables\Columns\BooleanColumn::make('is_visible')
                    ->label('Terlihat'),

                Tables\Columns\TextColumn::make('price')
                    ->money('IDR')
                    ->sortable(),

                // Tables\Columns\ImageColumn::make('image_icon')
                //     ->label('Ikon')
                //     ->extraAttributes(function (TourPackage $tourPackage) {
                //         return [
                //             'src' => $tourPackage->image_icon
                //                 ? asset('storage/' . $tourPackage->image_icon)
                //                 : null,
                //         ];
                //     })
                //     ->height(4),

                Tables\Columns\TextColumn::make('updated_at')
                    ->formatStateUsing(function ($state) {
                        $date = \Carbon\Carbon::parse($state);
                        $diff = $date->diffForHumans();

                        return match (true) {
                            $date->isToday() => "Hari ini, {$date->format('H:i')}",
                            $date->isYesterday() => 'Kemarin',
                            default => $diff,
                        };
                    })
                    ->sortable(),
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTourPackages::route('/'),
            'create' => Pages\CreateTourPackage::route('/create'),
            'edit' => Pages\EditTourPackage::route('/{record}/edit'),
        ];
    }
}
