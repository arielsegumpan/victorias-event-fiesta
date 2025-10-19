<x-mail::message>
# Thank You for Reaching Out!

Hi {{ $name }},

Thank you for contacting us! We have received your message and our team will review it shortly.

We typically respond within 24-48 hours during business days. If your inquiry is urgent, please feel free to call us directly.

<x-mail::panel>
We appreciate your interest in {{ config('app.name') }} and look forward to assisting you.
</x-mail::panel>

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
