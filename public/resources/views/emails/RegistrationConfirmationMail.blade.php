@component('mail::message')
Dear {{ $details['dealer_title'] }} {{ $details['dealer_name'] }},

## Your online registration in complete!!


@component('mail::button', ['url' => 'http://www.reliantpay.com'])
Learn More about us
@endcomponent

Thanks,<br>
{{ config('app.name') }} <br>
T: 95919 00000
@endcomponent
