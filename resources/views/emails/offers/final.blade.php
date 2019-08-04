@component('mail::message')
# Hello {{$user['name']}}

You have received contact information from the quote you submitted

@component('mail::button', ['url' => $url."app-dashboard/confirmed"])
Watch contact details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
