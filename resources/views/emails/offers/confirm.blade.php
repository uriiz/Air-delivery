@component('mail::message')
# התראה חדשה

יש הצעת מחיר חדשה שיבואן מעוניין בה, צריך לאשר.

@component('mail::button', ['url' => $url."admin-confirm"])
כניסה לאתר
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
