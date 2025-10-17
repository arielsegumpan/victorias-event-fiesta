<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Fiesta;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class FiestaObserver
{
    /**
     * Handle the Fiesta "created" event.
     */
    public function created(Fiesta $fiesta): void
    {
        if (Auth::check() && Auth::user()->hasAnyRole(['barangay captain','barangay_captain','brgy captain','brgy_captain','captain'])) {
            $this->notifyAdmin($fiesta);
        }
    }

    /**
     * Handle the Fiesta "updated" event.
     */
    public function updated(Fiesta $fiesta): void
    {
        // $this->notifyKapitan($fiesta);

        if (Auth::check() && Auth::user()->hasRole('super_admin')) {
            $this->notifyKapitan($fiesta);
        }
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


     /**
     * Create a Notification instance.
     */
    private function createNotification(string $title, string $body, Fiesta $fiesta, User $recipient): Notification
    {
        $url = $recipient->hasRole('super_admin')
            ? \App\Filament\Admin\Resources\FiestaResource::getUrl('edit', ['record' => $fiesta], panel: 'admin')
            : \App\Filament\Fiesta\Resources\FiestaResource::getUrl('edit', ['record' => $fiesta], panel: 'fiesta');

        return Notification::make()
            ->title($title)
            ->icon('phosphor-confetti')
            ->body($body)
            ->actions([
                Action::make('View')
                    ->button()
                    ->icon('heroicon-o-eye')
                    ->label('View')
                    ->url($url),
            ]);
    }


    /**
     * Notify all brgy captains about the new announcement.
     */
    private function notifyKapitan(Fiesta $fiesta): void
    {
        // Only notify the creator if they have a captain role
        $creator = $fiesta->creator;

        if ($creator && $creator->hasAnyRole([
            'barangay captain',
            'barangay_captain',
            'brgy captain',
            'brgy_captain',
            'captain',
        ]))
        {
            $notification = $this->createNotification(
                'Fiesta Approved',
                "Your fiesta '{$fiesta->f_name}' has been approved by the city administrator.",
                $fiesta,
                $creator
            );
            $notification->sendToDatabase($creator);
        }
    }

    /**
     * Notify all super_admin users about the new fiesta.
     */
    private function notifyAdmin(Fiesta $fiesta): void
    {
        $creator = $fiesta->creator;

        // Get all super_admin users
        $admins = User::role('super_admin')->get();

        foreach ($admins as $admin) {
            $notification = $this->createNotification(
                'New Fiesta Submission',
                "A new fiesta '{$fiesta->f_name}' has been created by {$creator->name} and is awaiting approval.",
                $fiesta,
                $admin
            );
            $notification->sendToDatabase($admin);
        }
    }
}
