<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\FiestaEvent;
use App\Livewire\Pages\BarangayPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\FiestaEventSingle;
use App\Livewire\Pages\BarangaySinglePage;



Route::get('/', HomePage::class)->name('home.page');
Route::get('/barangays', BarangayPage::class)->name('barangays.page');
Route::get('/barangays/{brgy_slug}', BarangaySinglePage::class)->name('barangay-single.page');
Route::get('/fiesta-eventos', FiestaEvent::class)->name('fiesta-eventos.page');
Route::get('/fiesta-eventos/{f_slug}', FiestaEventSingle::class)->name('fiesta-eventos-single.page');
Route::get('/contact', Contact::class)->name('contact.page');
Route::get('/about', About::class)->name('about.page');
Route::post('/logout', function () {
    // Logout from main app
    Auth::logout();

    // Also logout from Filament if using same users
    if (class_exists(\Filament\Facades\Filament::class)) {
        \Filament\Facades\Filament::auth()->logout();
    }

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->middleware('auth')->name('logout');
