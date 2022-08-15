@component('mail::message')
# Hi,

You are receiving this because, you have have requested to change your password to your account. Please you the link below.

@component('mail::button', ['url' => url('/reset-password?email='.$user->email."&token=".$user->token)])
 Set Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
