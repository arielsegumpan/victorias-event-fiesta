<?php

use App\Livewire\Pages\About;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\FiestaEvent;
use App\Livewire\Pages\FiestaEventSingle;
use Illuminate\Support\Facades\Route;



Route::get('/', HomePage::class)->name('home.page');
Route::get('/fiesta-eventos', FiestaEvent::class)->name('fiesta-eventos.page');
Route::get('/fiesta-eventos/{f_slug}', FiestaEventSingle::class)->name('fiesta-eventos-single.page');
Route::get('/contact', Contact::class)->name('contact.page');
Route::get('/about', About::class)->name('about.page');
