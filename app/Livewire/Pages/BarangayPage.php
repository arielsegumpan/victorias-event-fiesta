<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Barangay;
use Livewire\Attributes\Computed;

class BarangayPage extends Component
{
    #[Computed]
    public function barangays()
    {
        return Barangay::where('is_published', true)->get();
    }
    
    public function render()
    {
        return view('livewire.pages.barangay-page');
    }
}
