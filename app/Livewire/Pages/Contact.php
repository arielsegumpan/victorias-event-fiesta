<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Mail\ContactMail;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminNotification;
use App\Models\Contact as ContactModel;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Contact extends Component
{

    #[Validate('required|string|min:2|max:80|regex:/^[a-zA-Z\s]+$/')]
    public string $firstName = '';

    #[Validate('required|string|min:2|max:80|regex:/^[a-zA-Z\s]+$/')]
    public string $lastName = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('required|string|regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/|min:10|max:20')]
    public string $phone = '';

    #[Validate('required|string|min:10|max:1000')]
    public string $message = '';

    public bool $submitted = false;


    public function submit()
    {
        $key = 'contact-form:' . request()->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            throw ValidationException::withMessages([
                'email' => "Too many contact attempts. Please try again in " . ceil($seconds / 60) . " minutes."
            ]);
        }

        // Validate the form
        $validated = $this->validate();

        // Combine first and last name
        $fullName = Str::title(trim($validated['firstName'] . ' ' . $validated['lastName']));

        // Sanitize inputs (Laravel does this automatically, but being explicit)
        $sanitizedData = [
            'user_id' => auth()->id(),
            'name' => strip_tags($fullName),
            'email' => Str::lower(filter_var($validated['email'], FILTER_SANITIZE_EMAIL)),
            'phone' => preg_replace('/[^0-9+\-\s().]/', '', $validated['phone']),
            'message' => strip_tags($validated['message']),
            'is_replied' => false,
        ];

        // Create contact record
        ContactModel::create($sanitizedData);

        // Increment rate limiter
        RateLimiter::hit($key, 3600); // 1 hour decay


        Mail::to(config('mail.admin_email'))
            ->send(new ContactAdminNotification(
                $sanitizedData['name'],
                $sanitizedData['email'],
                $sanitizedData['phone'],
                $sanitizedData['message']
            ));

        Mail::to($sanitizedData['email'])->send(new ContactMail($sanitizedData['name']));

        $this->reset(['firstName', 'lastName', 'email', 'phone', 'message']);
        $this->submitted = true;
    }

    public function resetForm()
    {
        $this->reset();
        $this->submitted = false;
    }

    public function render()
    {
        return view('livewire.pages.contact');
    }
}
