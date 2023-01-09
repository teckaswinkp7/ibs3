@component('mail::message')
# Please Create Proforma Invoice for Course Enrollment.

This is to remind that proforma invoice need to be created for enrollment

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
