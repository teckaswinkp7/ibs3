@component('mail::message')
# Raise an Invoice Reminder.

Raise an Invoice for Enrollment.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
