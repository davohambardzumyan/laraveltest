@component('mail::message')
You are receiving this email because we received a password reset request for your account.

@component('mail::button', ['url' => $resetPasswordUrl])
Reset Password
@endcomponent

Reset Password link will be valid for 6 hour.

If you did not request a password reset, just ignore this email.

If your link expired, you can always request a new one here:
[{{$reRequestUrl}}]({{$reRequestUrl}})


@slot('subcopy')
If you’re having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
[{{$resetPasswordUrl}}]({{$resetPasswordUrl}})
@endslot

@endcomponent
