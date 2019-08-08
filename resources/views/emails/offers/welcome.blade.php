@component('mail::message')
# {{$company['company_name']}}

Welcome to Freight-Me, {{$company['name']}}

From now on you can get hundreds or thousands of shipping arrangements that you can meet at a quote you offer
@component('mail::button', ['url' => $url."app-dashboard"])
Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
