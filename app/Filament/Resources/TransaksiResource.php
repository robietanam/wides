<?php

namespace App\Filament\Resources;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\TourPackage;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Cache;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\TransaksiResource\Pages;
use Illuminate\Support\Facades\Log;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'Management';
    protected static ?string $pluralModelLabel = 'Transaksi';
    protected static ?string $slug = 'transaksi';

    public static function form(Form $form): Form
    {
        function applyDiscount($total, $discount)
        {
            $discountAmount = ($discount / 100) * $total;
            return number_format($total - $discountAmount, 0, ',', '.');
        }

        function calculateTotalAmount(callable $get)
        {
            $price = intval(str_replace('.', '', $get('_price') ?? '0'));
            $quantity = intval($get('quantity') ?? 1);
            $total = $price * $quantity;
            
            $discount = intval(str_replace('.', '', $get('discount') ?? '0'));
            return applyDiscount($total, $discount);
        }

        return $form
            ->schema([
                Section::make('Customer Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Customer')
                            ->required(),

                        TextInput::make('email')
                            ->label('Email')
                            ->required()
                            ->email(),

                        TextInput::make('noTelp')
                            ->label('Nomor Telepon')
                            ->required(),

                        TextInput::make('discount')
                            ->numeric()
                            ->minValue(0)
                            ->maxValue(100)
                            ->default(0)
                            ->label('Diskon (%)')
                            ->helperText('Masukkan persentase diskon (misalnya: 10 untuk diskon 10%)')
                            ->reactive()
                            ->afterStateUpdated(function (callable $get, callable $set) {
                                $set('total', calculateTotalAmount($get));
                            }),

                        ToggleButtons::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'processing' => 'Processing',
                                'invoice' => 'Invoice',
                                'completed' => 'Completed',
                                'rejected' => 'Rejected',
                                'refunded' => 'Refunded',
                            ])
                            ->default('pending')
                            ->label('Status Transaksi')
                            ->inline(),

                        Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->relationship('paymentMethod', 'payment_name')
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Detail Transaksi')
                    ->schema([
                        Select::make('package_name')
                            ->relationship('tourPackage', 'name')
                            ->required()
                            ->label('Paket Wisata')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $package = TourPackage::where('name', $state)->first();
                                $price = $package->price ?? 0; // Assuming this is the price of the package
                                $quantity = $get('quantity') ?? 1;
                                $formattedPrice = number_format($price, 0, ',', '.');
                                $set('_price', $formattedPrice); // Assuming price is set based on the package
                                $set('price', $price);
                                
                                // Recalculate amount and total
                                $set('amount', number_format($price * $quantity, 0, ',', '.'));
                                $set('total', calculateTotalAmount($get)); // Update total
                                $set('package_name', $package->name ?? '');
                            }),            

                            DatePicker::make('visit_date'),

                            TextInput::make('quantity')
                                ->numeric()
                                ->required()
                                ->label('Jumlah')
                                ->default(1)
                                ->minValue(1)
                                ->maxValue(100)
                                ->reactive()
                                ->afterStateUpdated(function (callable $get, callable $set) {
                                    $price = intval(str_replace('.', '', $get('_price') ?? '0'));
                                    $quantity = intval($get('quantity') ?? 1);
                                    $set('amount', number_format($price * $quantity, 0, ',', '.'));

                                    // Recalculate total amount
                                    $set('total', calculateTotalAmount($get));
                                }),


                            TextInput::make('total')
                                ->numeric()
                                ->disabled()
                                ->prefix('IDR')
                                ->label('Total Pembayaran')
                                ->default(fn($get) => calculateTotalAmount($get))
                                ->afterStateUpdated(function (callable $get, callable $set) {
                                    $set('total', calculateTotalAmount($get));
                                }),
                                ])
                                ->columns(2),
                            Hidden::make('price')
                                ->default(fn ($get) => $get('price'))
                                ->label('price'),
                            Hidden::make('transaction_code')
                                ->default(fn () => (new Transaction())->generateTransactionCode(true))
                                ->label('Transaction Code'),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_code')
                    ->label('Kode Transaksi')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['class' => 'font-semibold text-blue-600']),

                BadgeColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->icons([
                        'heroicon-o-clock' => 'pending',
                        'heroicon-o-arrow-path' => 'processing',
                        'heroicon-o-document-text' => 'invoice',
                        'heroicon-o-check-circle' => 'completed',
                        'heroicon-o-x-circle' => 'rejected',
                        'heroicon-o-arrow-left-on-rectangle' => 'refunded',
                    ])
                    ->colors([
                        'primary' => 'pending',
                        'warning' => 'processing',
                        'info' => 'invoice',
                        'success' => 'completed',
                        'danger' => 'rejected',
                        'gray' => 'refunded',
                    ]),

                TextColumn::make('name')
                    ->label('Nama Customer')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['class' => 'text-gray-800']),

                TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->sortable()
                    ->searchable()
                    ->extraAttributes(['class' => 'text-gray-600']),

                TextColumn::make('transaction_date')
                    ->label('Tanggal Transaksi')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return Cache::rememberForever("transaction_date_{$state}", function () use ($state) {
                            $date = \Carbon\Carbon::parse($state);
                            $diff = $date->diffForHumans();

                            return match (true) {
                                $date->isToday() => "Hari ini, {$date->format('H:i')}",
                                $date->isYesterday() => 'Kemarin',
                                default => $diff,
                            };
                        });
                    })
                    ->extraAttributes(['class' => 'text-gray-500']),
            ])
            ->defaultSort('transaction_date', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'invoice' => 'Invoice',
                        'completed' => 'Completed',
                        'rejected' => 'Rejected',
                        'refunded' => 'Refunded',
                    ])
                    ->multiple(),

                Filter::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->form([
                        Select::make('payment_method')
                            ->options([
                                'cash' => 'Cash',
                                'credit_card' => 'Kartu Kredit',
                                'bank_transfer' => 'Transfer Bank',
                                'e-wallet' => 'E-Walet',
                            ])
                            ->multiple(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['payment_method'],
                                fn(Builder $query, $payment_method): Builder => $query->whereIn('payment_method', $payment_method),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->slideOver(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->poll('10s');
    }

    public static function getRelations(): array
    {
        return [
            // ...
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            'create' => Pages\CreateTransaksi::route('/create'),
            'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }
}

