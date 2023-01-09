@component('mail::message')
# Invoice Payment Due Reminder. 

Your invoice payment is due today. 

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
