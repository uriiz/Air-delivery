@component('mail::message')
# Hello {{$user['name']}}

You have received a new quote request.
<table class="blueTable" style="border: 1px solid #000">
    <thead>
    <tr style="border: 1px solid black;">
        <th style="border: 1px solid black;"></th>
        <th style="border: 1px solid black;">from</th>
        <th style="border: 1px solid black;">to</th>
    </tr>
    </thead>
    <tbody>
    <tr style="border: 1px solid black;">
        <td style="border: 1px solid black;font-weight: bold">address:</td>
        <td style="border: 1px solid black;">{{$offer['from_address_name']}}</td>
        <td style="border: 1px solid black;">{{$offer['to_address_name']}}</td>
    </tr>

    </tbody>
</table>

@component('mail::button', ['url' => $url."app-dashboard"])
    My dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
