<?php


namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;
use Filament\Http\Responses\Auth\LoginResponse as BaseLogin;


class LoginResponse extends BaseLogin
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     */

    public function toResponse($request): RedirectResponse | Redirector
    {
        return redirect()->to(Auth::user()->usersPanel());
    }
}
