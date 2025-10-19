<?php

namespace App\Livewire\Components;

use App\Models\Fiesta;
use App\Models\Review;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;

class FiestaReview extends Component
{
    use WithFileUploads;

    #[Locked]
    public int $fiestaId;

    public int $rating = 0;
    public string $review = '';
    public array $review_images = [];

    public function mount(Fiesta $fiesta)
    {
        $this->fiestaId = $fiesta->id;
    }

    #[Computed]
    public function reviews()
    {
        return Review::query()
            ->where('fiesta_id', $this->fiestaId)
            ->with('user:id,name,email')
            ->select('id', 'fiesta_id', 'user_id', 'rating', 'review', 'review_images', 'created_at')
            ->latest()
            ->get();
    }

    public function rules()
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'review' => ['required', 'min:3', 'max:2048'],
            'review_images' => ['nullable', 'array', 'max:5'],
            'review_images.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'review_images.max' => 'You can upload a maximum of 5 images.',
            'review_images.*.max' => 'Each image must be less than 2MB.',
            'review_images.*.mimes' => 'Only JPEG, JPG and PNG images are allowed.',
            'review_images.*.image' => 'Only JPEG, JPG and PNG images are allowed.',
            'review.max' => 'The review must be less than 2048 characters.',
            'review.min' => 'The review must be at least 3 characters.',
            'rating.min' => 'The rating must be at least 1.',
            'rating.max' => 'The rating must be at most 5.',
            'rating.required' => 'The rating field is required.',
            'review.required' => 'The review field is required.',
        ];
    }

    public function submitReview()
    {
        $this->validate();

        $storedImages = collect($this->review_images)
            ->map(function($img) {
                $extension = $img->getClientOriginalExtension();
                $filename = strtoupper(\Illuminate\Support\Str::ulid()) . '.' . $extension;
                return $img->storeAs('reviews', $filename, 'public');
            })
            ->toArray();

        DB::transaction(function () use ($storedImages) {
            Review::create([
                'fiesta_id' => $this->fiestaId,
                'user_id' => auth()->id(),
                'rating' => intval($this->rating),
                'review' => strip_tags($this->review),
                'review_images' => $storedImages,
                'is_approved' => 0,
            ]);
        });

        $this->reset(['rating', 'review', 'review_images']);
        unset($this->reviews);
    }

    public function removeTempImage($index)
    {
        if (isset($this->review_images[$index])) {
            unset($this->review_images[$index]);
            $this->review_images = array_values($this->review_images);
        }
    }

    public function render()
    {
        return view('livewire.components.fiesta-review');
    }
}
