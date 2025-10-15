<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Barangay;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Computed;

#[Lazy]
class BarangaySinglePage extends Component
{
    protected $bgyId;
    protected $userId;

    public function mount($brgy_slug)
    {
        $barangay = Barangay::select('id', 'created_by')
            ->where('brgy_slug', $brgy_slug)
            ->firstOrFail();
        $this->bgyId = $barangay->id;
        $this->userId = $barangay->user_id;
    }

    #[Computed]
    public function barangay()
    {
        return Barangay::select([
                'id', 'brgy_name', 'brgy_slug', 'brgy_logo', 'brgy_img_gallery',
                'brgy_desc', 'brgy_address', 'brgy_contact', 'brgy_email',
                'brgy_facebook', 'brgy_twitter', 'brgy_instagram', 'brgy_youtube',
                'brgy_tiktok', 'created_by'
            ])
            ->with([
                'currentCaptain.user:id,name,email',
                'currentCaptain.user.roles:id,name',
                'barangayCaptains' => fn($q) => $q->with('user:id,name')
                    ->orderBy('term_start', 'desc'),
                'fiestas' => fn($q) => $q->where('is_published', true)
                    ->select('id', 'barangay_id', 'f_name', 'f_slug', 'f_images', 'f_start_date', 'f_end_date'),
            ])
            ->where('is_published', true)
            ->findOrFail($this->bgyId);
    }

    #[Computed]
    public function currentCaptain()
    {
        return $this->barangay->currentCaptain;
    }


    public function render()
    {
        return view('livewire.pages.barangay-single-page');
    }
}
