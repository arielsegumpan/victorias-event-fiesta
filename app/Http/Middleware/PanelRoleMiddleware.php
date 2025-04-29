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
            'fiesta' => 'barangay captain',
            'fiesta' => 'barangay_captain',
        ];

        $requiredRole = $panelRoles[$currentPanelId] ?? null;

        // If no role is mapped for this panel or user doesn't have the role
        if (!$requiredRole || !$user->hasRole($requiredRole)) {

            // Redirect based on user role
            if ($user->hasRole('super_admin')) {
                return redirect()->route('filament.admin.pages.dashboard');
            }

            if ($user->hasRole('fiesta')) {
                return redirect()->route('filament.fiesta.pages.dashboard');
            }

            // Fallback if role doesn't match any panel
            return redirect()->route('filament.auth.auth.login');
        }

        // User has the correct role for the current panel
        return $next($request);

    }
}
