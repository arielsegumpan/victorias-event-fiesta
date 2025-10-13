<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;

class HomePage extends Component
{

    #[Computed()]
    public function displayFiestas()
    {
        return Fiesta::with('category:id,cat_name')
        ->where('is_published', 1)
        ->where('is_featured', 1)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
    }

    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
