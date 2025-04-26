<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use App\Filament\Auth\Pages\Register;
use Filament\Http\Middleware\Authenticate;
use App\Http\Middleware\PanelRoleMiddleware;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AuthPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('auth')
            ->path('auth')
            ->colors([
                'primary' => Color::Orange,
            ])
            ->login()
            ->registration(Register::class)
            ->font('Poppins')
            ->brandLogo(asset('imgs/vfs.png'))
            ->brandLogoHeight('3rem')
            ->favicon(asset('imgs/vfs.png'))
            ->discoverResources(in: app_path('Filament/Auth/Resources'), for: 'App\\Filament\\Auth\\Resources')
            ->discoverPages(in: app_path('Filament/Auth/Pages'), for: 'App\\Filament\\Auth\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Auth/Widgets'), for: 'App\\Filament\\Auth\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
                PanelRoleMiddleware::class,
                Authenticate::class,
            ]);
    }
}
