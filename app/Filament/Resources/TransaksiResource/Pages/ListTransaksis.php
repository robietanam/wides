<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TransaksiResource;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Widgets\RevenueTransactionOverview;


class ListTransaksis extends ListRecords
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RevenueTransactionOverview::class
        ];
    }

    public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'invoice' => Tab::make()->query(fn($query) => $query->where('status', 'invoice')),
            'processing' => Tab::make()->query(fn($query) => $query->where('status', 'processing')),
            'completed' => Tab::make()->query(fn($query) => $query->where('status', 'completed')),
            'refunded' => Tab::make()->query(fn($query) => $query->where('status', 'refunded')),
            'rejected' => Tab::make()->query(fn($query) => $query->where('status', 'rejected')),
        ];
    }
}
