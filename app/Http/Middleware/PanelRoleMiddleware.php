<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class PanelRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = $request->user();
        $currentPanelId = Filament::getCurrentPanel()?->getId();

        if (!$user || !$currentPanelId) {
            return redirect()->route('filament.auth.auth.login');
        }

        // Define panel-to-role mapping
        $panelRoles = [
            'admin' => 'super_admin',
            'fiesta' => ['barangay captain', 'barangay_captain'],
        ];

        $requiredRoles = $panelRoles[$currentPanelId] ?? [];

        if (!$user->hasAnyRole($requiredRoles)) {
            if ($user->hasRole('super_admin')) {
                return redirect()->to(Filament::getPanel('admin')->getUrl());
            }

            if ($user->hasAnyRole(['barangay captain', 'barangay_captain'])) {
                return redirect()->to(Filament::getPanel('fiesta')->getUrl());
            }

            return redirect()->route('filament.auth.auth.login');
        }
        return $next($request);

    }
}
