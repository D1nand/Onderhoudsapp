@component('mail::message')
# Set your password

To set your password, please click the button below and use the verification code: {{ $passwordCode }}

@component('mail::button', ['url' => route('set-password', ['code' => $passwordCode])])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
