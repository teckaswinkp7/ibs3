@component('mail::message')
# This is an Email Reminder to select the course.


Course Selection Reminder Email.

@component('mail::button', ['url' => ''])
click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
