<x-mail::message>
# Hello {{ $userName }},

Thank you for reaching out to us. We have reviewed your inquiry and here is our response:

<x-mail::panel>
{{ $replyMessage }}
</x-mail::panel>

---

## Your Original Message:
<div style="background-color: #f3f4f6; padding: 15px; border-left: 4px solid #9ca3af; margin: 20px 0;">
{!! nl2br(e($originalMessage)) !!}
</div>

---

If you have any additional questions or concerns, please don't hesitate to reach out to us again.

<x-mail::button :url="config('app.url') . '/contact'">
Contact Us Again
</x-mail::button>

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
