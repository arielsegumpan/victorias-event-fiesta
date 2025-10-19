<x-mail::message>
# New Contact Form Submission

You have received a new message from your website contact form.

**Name:** {{ $name }}
**Email:** {{ $email }}
**Phone:** {{ $phone }}

## Message:
{{ $message }}

<x-mail::button :url="config('app.url') . '/admin/contacts'">
View in Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
