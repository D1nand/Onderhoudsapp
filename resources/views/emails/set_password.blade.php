@component('mail::message')
# Set your password

To set your password, please click the button below and use the verification code: {{ $verificationCode }}

@component('mail::button', ['url' => route('set-password', ['code' => $verificationCode])])
Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
