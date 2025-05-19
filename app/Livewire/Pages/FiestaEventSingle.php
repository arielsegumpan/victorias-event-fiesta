<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Livewire\Attributes\Layout;

class FiestaEventSingle extends Component
{
    public $fiesta, $relatedFiesta;
    public function mount($f_slug)
    {
        $this->fiesta = Fiesta::with(['category', 'user', 'barangay'])->where('f_slug', $f_slug)->firstOrFail();

        $this->relatedFiesta = Fiesta::where('created_by', $this->fiesta->user_id)
            ->where('id', '!=', $this->fiesta->id)
            ->latest()
            ->take(5)
            ->get();
    }
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.fiesta-event-single',[
            'fiesta' => $this->fiesta,
            'relatedFiesta' => $this->relatedFiesta
        ]);
    }
}
