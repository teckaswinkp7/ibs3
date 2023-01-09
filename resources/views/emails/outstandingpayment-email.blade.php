@component('mail::message')
# outstanding Amount Reminder !!

There is an outstanding amount of $ in your enrollment.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
