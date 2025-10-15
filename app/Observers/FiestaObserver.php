<?php

namespace App\Observers;

use App\Models\Fiesta;
use App\Livewire\Pages\FiestaEvent;

class FiestaObserver
{
    /**
     * Handle the Fiesta "created" event.
     */
    public function created(Fiesta $fiesta): void
    {
        //
    }

    /**
     * Handle the Fiesta "updated" event.
     */
    public function updated(Fiesta $fiesta): void
    {
        // $fiestas = FiestaEvent::fiestas();
        // unset($fiestas);
    }

    /**
     * Handle the Fiesta "deleted" event.
     */
    public function deleted(Fiesta $fiesta): void
    {
        //
    }

    /**
     * Handle the Fiesta "restored" event.
     */
    public function restored(Fiesta $fiesta): void
    {
        //
    }

    /**
     * Handle the Fiesta "force deleted" event.
     */
    public function forceDeleted(Fiesta $fiesta): void
    {
        //
    }
}
