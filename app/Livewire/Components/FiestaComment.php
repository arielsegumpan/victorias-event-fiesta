<?php

namespace App\Livewire\Components;

use App\Models\Fiesta;
use Livewire\Component;
use App\Models\Comments;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class FiestaComment extends Component
{
    use WithFileUploads;

    public Fiesta $fiesta;

    public string $comment = '';
    public array $comment_imgs = [];

    public function rules()
    {
        return [
            'comment' => ['required', 'min:3', 'max:2048'],
            'comment_imgs' => ['nullable', 'array', 'max:5'],
            'comment_imgs.*' => ['image', 'mimes:jpg,jpeg,png', 'max:2048'], // each image max 2MB
        ];
    }


    public function mount(Fiesta $fiesta)
    {
        $this->fiesta = $fiesta;
    }

    public function submitComment()
    {
        $this->validate();

         $storedImages = collect($this->comment_imgs)
        ->map(function($img) {
            return $img->store('comments', 'public');
        })
        ->toArray();

        Comments::create([
            'fiesta_id' => $this->fiesta->id,
            'user_id'   => auth()->id(),
            'comment'   => strip_tags($this->comment),
            'comment_imgs' => json_encode($storedImages),
            'is_approved' => false,
        ]);

        $this->reset(['comment', 'comment_imgs']);

        $this->dispatch('comment-added');
    }

    public function removeTempImage($index)
    {
        if (isset($this->comment_imgs[$index])) {
            unset($this->comment_imgs[$index]);
            $this->comment_imgs = array_values($this->comment_imgs); // reindex
        }
    }

    public function render()
    {
         $comments = $this->fiesta->comments()->with('user')->latest()->get();
        return view('livewire.components.fiesta-comment',[
            'comments' => $comments
        ]);
    }
}
