<?php

use App\Livewire\Pages\HomePage;
use Illuminate\Support\Facades\Route;



Route::get('/', HomePage::class)->name('home.page');
