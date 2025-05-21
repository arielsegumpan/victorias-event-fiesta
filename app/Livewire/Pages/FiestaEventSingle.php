<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Livewire\Attributes\Layout;

class FiestaEventSingle extends Component
{
    public $fiesta, $relatedFiesta;
    public array $ratingStats = [];
    public function mount($f_slug)
    {
        $this->fiesta = Fiesta::with(['category', 'user', 'barangay'])->where('f_slug', $f_slug)->firstOrFail();

        $this->relatedFiesta = Fiesta::where('created_by', $this->fiesta->user_id)
            ->where('id', '!=', $this->fiesta->id)
            ->latest()
            ->take(5)
            ->get();

        $this->computeRatingStats();
    }

    protected function computeRatingStats()
    {
        $total = $this->fiesta->reviews->count();

        $counts = $this->fiesta->reviews->groupBy('rating')->map->count();

        // Prepare stats for ratings 5 to 1
        foreach ([5, 4, 3, 2, 1] as $star) {
            $count = $counts->get($star, 0);
            $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
            $this->ratingStats[$star] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }
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
