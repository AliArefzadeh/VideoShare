@component('mail::message')
    # Verify your email
    Your order has been shipped!
@component('mail::button',['url' => $url])
        verify email
@endcomponent
    Thanks,<br>
    {{config('app.name')}}
@endcomponent
