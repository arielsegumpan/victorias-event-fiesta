<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

class HomePage extends Component
{

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home-page');
    }
}
