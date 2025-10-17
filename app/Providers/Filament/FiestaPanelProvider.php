<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filafly\Icons\Phosphor\PhosphorIcons;
use Filament\Http\Middleware\Authenticate;
use App\Http\Middleware\PanelRoleMiddleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class FiestaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('fiesta')
            ->path('fiesta')
           ->colors([
                'primary' => Color::Orange,
            ])
            // ->sidebarCollapsibleOnDesktop()
             ->topNavigation()
            ->spa()
            ->font('Montserrat')
            ->sidebarWidth('15rem')
            ->brandLogo(asset('imgs/vfs.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('imgs/vfs.png'))
            ->discoverResources(in: app_path('Filament/Fiesta/Resources'), for: 'App\\Filament\\Fiesta\\Resources')
            ->discoverPages(in: app_path('Filament/Fiesta/Pages'), for: 'App\\Filament\\Fiesta\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Fiesta/Widgets'), for: 'App\\Filament\\Fiesta\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
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
                PanelRoleMiddleware::class
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                PhosphorIcons::make()->thin()
            ])
            ->databaseNotifications();
    }
}
