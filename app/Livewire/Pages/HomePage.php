<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Livewire\Attributes\Layout;

class HomePage extends Component
{

    public $display_fiestas;
    public function mount()
    {
        $this->display_fiestas = Fiesta::with('category:id,cat_name')
        ->where('is_published', 1)
        ->where('is_featured', 1)
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.home-page',[
            'display_fiestas' => $this->display_fiestas
        ]);
    }
}
