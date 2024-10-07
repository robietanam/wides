<?php

namespace App\Providers;

use App\Filament\Widgets\TourPackageSales;
use App\Models\Transaction;
use Filament\Facades\Filament;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Filament\Widgets\RevenueTransactionOverview;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Transaction::observe(TransactionObserver::class);

        Filament::serving(function () {
            Filament::registerWidgets([
                RevenueTransactionOverview::class,
                TourPackageSales::class
            ]);
        });
    }
}
