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
        return Barangay::select([
                'brgy_name',
                'brgy_slug',
                'brgy_logo',
                'brgy_img_gallery',
                'brgy_desc',
                'brgy_address',
                'brgy_contact',
                'brgy_email',
                'brgy_facebook',
                'brgy_twitter',
                'brgy_instagram',
                'brgy_youtube',
                'brgy_tiktok'
            ])
            ->where('is_published', true)
            ->get()
            ->map(function ($barangay) {
                //kwa max 5 images sa img gallery
                if (is_array($barangay->brgy_img_gallery) && count($barangay->brgy_img_gallery) > 5) {
                    $barangay->brgy_img_gallery = array_slice($barangay->brgy_img_gallery, 0, 5);
                }
                return $barangay;
            });
    }

    public function render()
    {
        return view('livewire.pages.barangay-page');
    }
}
