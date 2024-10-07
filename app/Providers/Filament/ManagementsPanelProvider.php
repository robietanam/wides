<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use App\Filament\Widgets\TourPackageSales;
use Filament\Http\Middleware\Authenticate;
use App\Filament\Resources\TransaksiResource;
use App\Filament\Resources\TourPackageResource;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use App\Filament\Widgets\LatestTransactionsWidget;
use App\Filament\Widgets\RevenueTransactionOverview;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class ManagementsPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('managements')
            ->path('managements')
            ->login()
            ->sidebarCollapsibleOnDesktop()
            // ->databaseNotifications()
            // ->databaseNotificationsPolling('30s')
            ->colors([
                'primary' => Color::Violet,
                'Gray' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                RevenueTransactionOverview::class,
                TourPackageSales::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->navigationItems([
                NavigationItem::make('Beranda')
                    ->label(fn(): string => __('filament-panels::pages/dashboard.title'))
                    ->icon('heroicon-o-rectangle-group')
                    ->url(fn(): string => Dashboard::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.managements.pages.dashboard')),
                // NavigationItem::make('Analytics')
                //     // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                //     ->icon('heroicon-o-presentation-chart-line')
                //     ->group('Reports')
                //     ->sort(1),
                NavigationItem::make('Review')
                    // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-star')
                    ->group('Reports')
                    ->sort(2),
                NavigationItem::make('Paket Layanan')
                    // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->url(fn(): string => TourPackageResource::getUrl())
                    ->isActiveWhen(fn() => request()->routeIs('filament.managements.pages.tour-package'))
                    ->icon('heroicon-o-ticket')
                    ->group('Management')
                    ->sort(1),
                NavigationItem::make('Transaksi')
                    ->url(fn(): string => TransaksiResource::getUrl())
                    ->icon('heroicon-o-bold')
                    ->group('Management')
                    ->sort(2),
                NavigationItem::make('Pengguna')
                    // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-s-user-group')
                    ->group('Users')
                    ->sort(1),
                NavigationItem::make('Permission')
                    // ->url('https://filament.pirsch.io', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-lock-closed')
                    ->group('Users')
                    ->sort(2)
            ])
            ->userMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    // ->url(fn(): string => Settings::getUrl())
                    ->icon('heroicon-o-cog-6-tooth'),
                // ...
            ]);
    }
}
