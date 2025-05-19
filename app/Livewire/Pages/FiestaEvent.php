<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class FiestaEvent extends Component
{
    use WithPagination;
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.pages.fiesta-event', [
            'fiestas' => $this->getFiestas(),
            'fiesta_top_content' => $this->getFiestaTopContent(),
        ]);
    }

    public function getFiestas()
    {
        return Fiesta::with(['category', 'user', 'barangay'])
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->through(function ($fiesta_strip) {
                $fiesta_strip->strip_content = Str::limit(strip_tags($fiesta_strip->f_description), 70);
                return $fiesta_strip;
            });
    }

    public function getFiestaTopContent()
    {
        return Fiesta::with(['category', 'user', 'barangay'])
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
