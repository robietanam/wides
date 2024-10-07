<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PaymentMethodResource\Pages;
use App\Models\PaymentMethod;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;

class PaymentMethodResource extends Resource
{
    protected static ?string $model = PaymentMethod::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Management';
    protected static ?int $navigationSort = 3;
    protected static ?string $label = 'Payment Method';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'Cash' => 'Cash',
                        'E-Wallet' => 'E-Wallet',
                        'Transfer Bank' => 'Transfer Bank',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('payment_name')
                    ->unique()
                    ->label('Nama Pembayaran'),
                Forms\Components\TextInput::make('account_holder')
                    ->label('Atas Nama')
                    ->required(fn ($get) => $get('type') !== 'cash')
                    ->hidden(fn ($get) => $get('type') === 'cash'),
                Forms\Components\TextInput::make('account_number')
                    ->label('Nomor Akun')
                    ->placeholder('Masukkan nomor rekening atau No E-wallet')
                    ->required(fn ($get) => $get('type') !== 'cash')
                    ->hidden(fn ($get) => $get('type') === 'cash'),
                Forms\Components\Toggle::make('isActivated')
                    ->label('Is Activated')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->label('Payment Type')
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_name')
                    ->label('Nama Pembayaran'),
                Tables\Columns\TextColumn::make('account_holder')
                    ->label('Account Holder'),
                Tables\Columns\TextColumn::make('account_number')
                    ->label('Account Number'),
                Tables\Columns\BooleanColumn::make('isActivated')
                    ->label('Is Active')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'cash' => 'Cash',
                        'e_wallet' => 'E-Wallet',
                        'bank_transfer' => 'Bank Transfer',
                    ])
                    ->label('Payment Type')
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPaymentMethods::route('/'),
            'create' => Pages\CreatePaymentMethod::route('/create'),
            'edit' => Pages\EditPaymentMethod::route('/{record}/edit'),
        ];
    }
}
