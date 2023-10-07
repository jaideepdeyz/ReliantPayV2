@component('mail::message')

Dear {{ $details['firstname'] }} {{ $details['lastname'] }},

## Greetings from Reliant Pay!!

Thanks for reaching out to us. We have received your query and we will get back to you shortly.

Your Message: {{ $details['message'] }}

@component('mail::button', ['url' => 'http://www.reliantpay.com'])
Learn More about us
@endcomponent

Thanks,<br>
{{ config('app.name') }} <br>
T: +91 95919 00000

@endcomponent
