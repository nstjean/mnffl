@component('mail::message')
{{-- Greeting --}}
# @lang('Welcome, '.$user->name.'!')

An account was created for you on <b>MNFFL.net</b><br/>

Your registered email to use for logging in: <b> {{$user->email}} </b><br/>

@component('mail::button', ['url' => url('/login')])
Log In Here
@endcomponent

If the administrator did not give you your password you can reset it here:

@component('mail::button', ['url' => url('/password/reset')])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}


{{-- Subcopy --}}
@slot('subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser: [:actionURL](:actionURL)',
    [
        'actionText' => 'Reset Password',
        'actionURL' => url('/password/reset'),
    ]
)
@endslot
@endcomponent
