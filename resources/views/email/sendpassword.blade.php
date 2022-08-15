@component('mail::message')
# Hi,

You are receiving this because, your email have been used to create an account on the Municipality Activity Logger system. Please do use the below details to log in;

- # email : {{$credentials['user']}}
- # password : {{$credentials['password']}}


@component('mail::button', ['url' => url('/login')])
    LOG IN
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
