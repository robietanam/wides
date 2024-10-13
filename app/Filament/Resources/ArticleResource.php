<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationGroup = 'Website';
    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->required()
                    ->disk('public')
                    ->directory('fauna-thumbnails'),

                Forms\Components\TextInput::make('slug')
                    ->label('Judul')
                    ->required()
                    ->unique(Article::class, 'slug', ignoreRecord: true),
                    
                Forms\Components\Placeholder::make('qr_code')
                    ->label('QR Code')
                    ->content(function ($record) {
                        if ($record) {
                            $qrCodeContent = base64_encode(QrCode::format('svg')->size(250)->generate(url(config('app.url') . "/artikel/id/{$record->id}")));

                            // Create an inline SVG tag for display
                            $svgImage = "<img src='data:image/svg+xml;base64,{$qrCodeContent}' alt='QR Code' />";
                
                            // Provide a download link for the QR code as a base64 file
                            $downloadLink = '<a href="data:image/svg+xml;base64,'. $qrCodeContent .'" download="fauna-'. $record->slug .'.svg"
                                            style="padding: 0.5rem 1rem; background-color: #3B82F6; color: white; border-radius: 0.375rem; text-align: center; text-decoration: none; transition: background-color 0.3s;"
                                            >
                                            Download 
                                        </a>';
                
                            // Return the HTML string to display the QR code and download link
                            return new HtmlString("<div>{$svgImage}</div><button style='margin-top: 1rem'>{$downloadLink}</button>");
                        }
                        return 'QR code akan muncul setelah dibuat.';
                    }
                ),

                TiptapEditor::make('detailed_description')
                    ->label('Deskripsi Lengkap')
                    ->profile('default')
                    ->columnSpan('full')  
                    ->directory('artikel/attachment') 
                    ->output(TiptapOutput::Html)
                    ->maxContentWidth('5xl')
                    ->required(),

                Forms\Components\Repeater::make('short_descriptions')
                    ->label('Tambahkan Deskripsi Singkat')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),

                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->toolbarButtons(['italic','bold','strike','underline'])
                            ->extraInputAttributes(['style' => 'min-height: 1.5rem; max-height: 50vh; overflow-y: auto;'])
                            ->required(),
                    ])
                    ->collapsible()
                    ->columnSpan(2),

                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('slug')->label('Judul')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
