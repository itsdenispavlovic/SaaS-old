@component('mail::message')
# New Mail (Contact form)

<strong>Contact Type: </strong> {{ $emailData['contact_type'] }} <br>
<strong>Name: </strong> {{ $emailData['name'] }} <br>
<strong>Email: </strong> {{ $emailData['email'] }} <br>
<strong>Content: </strong> <br>
{!! $emailData['content'] !!}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
