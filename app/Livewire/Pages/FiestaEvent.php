<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

class FiestaEvent extends Component
{
    use WithPagination;

    public function render()
    {
        $pyesta = Fiesta::with(['category', 'user', 'barangay'])
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(6)
            ->through(function ($fiesta_strip) {
                $fiesta_strip->strip_content = Str::limit(strip_tags($fiesta_strip->f_description), 70);
                return $fiesta_strip;
            });
        return view('livewire.pages.fiesta-event', ['pyestas' => $pyesta]);
    }

    #[Computed]
    public function fiestas()
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

    #[Computed]
    public function fiestaTopContent()
    {
        return Fiesta::with(['category', 'user', 'barangay'])
            ->where('is_published', 1)
            ->where('is_featured', 1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
