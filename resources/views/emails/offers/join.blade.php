@component('mail::message')
# Introduction
A new shipping company wants to join the site


@component('mail::button', ['url' => $url."admin-waiting-shipper"])
Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
