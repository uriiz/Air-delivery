@component('mail::message')
# Hello {{$user['name']}}

You have received a new quote.

@component('mail::button', ['url' => $url."dashboard"])
My dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
