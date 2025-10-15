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
        return Barangay::select(['brgy_name', 'brgy_slug', 'brgy_logo', 'brgy_img_gallery', 'brgy_desc', 'brgy_address', 'brgy_contact', 'brgy_email', 'brgy_facebook','brgy_twitter','brgy_instagram','brgy_youtube', 'brgy_tiktok'])->where('is_published', true)->get();
    }

    public function render()
    {
        return view('livewire.pages.barangay-page');
    }
}
