<?php

namespace App\Livewire\Pages;

use App\Models\Fiesta;
use Livewire\Component;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Lazy]
class FiestaEventSingle extends Component
{
    public $fiestaId;
    public $userId;

    public function mount($f_slug)
    {
        $fiesta = Fiesta::select('id', 'created_by')
            ->where('f_slug', $f_slug)
            ->firstOrFail();
        $this->fiestaId = $fiesta->id;
        $this->userId = $fiesta->user_id;
    }

    #[Computed]
    public function fiesta()
    {
        return Fiesta::with([
            'category:id,cat_name',
            'user:id,name,email',
            'barangay' => fn($q) => $q->where('is_published', true)->select('id', 'brgy_name'),
            'reviews:id,fiesta_id,rating'
        ])
        ->findOrFail($this->fiestaId);
    }

    #[Computed]
    public function relatedFiesta()
    {
        return Fiesta::select('id', 'f_slug', 'f_name', 'created_at')
            ->where('created_by', $this->userId)
            ->where('id', '!=', $this->fiestaId)
            ->latest()
            ->take(5)
            ->get();
    }

    #[Computed]
    public function ratingStats()
    {
        $reviews = $this->fiesta->reviews;
        $total = $reviews->count();

        if ($total === 0) {
            return collect([5, 4, 3, 2, 1])->mapWithKeys(fn($star) => [
                $star => ['count' => 0, 'percentage' => 0]
            ])->toArray();
        }

        $counts = $reviews->countBy('rating');

        return collect([5, 4, 3, 2, 1])->mapWithKeys(function($star) use ($counts, $total) {
            $count = $counts->get($star, 0);
            return [$star => [
                'count' => $count,
                'percentage' => round(($count / $total) * 100)
            ]];
        })->toArray();
    }

    // public function placeholder()
    // {
    //     return view('livewire.placeholders.fiesta-loading');
    // }

    public function render()
    {
        return view('livewire.pages.fiesta-event-single');
    }
}
