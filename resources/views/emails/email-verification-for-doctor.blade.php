@component('mail::message')
# Hello {{$doctor['name']}},
<br>

Thank you for Signing up! We just need you to verify your email address to complete setting up your account. 


@component('mail::button', [
    'url' => url('/confirm-doctor/' . $doctor['hash'].'-'.date('y-m-d-'.$doctor['id'].'-H-i-s')),
    'color' => 'red'
    ])
    Accept
    @endcomponent
    
    {{--dd($doctor)--}}
Thanks,<br>
Innet.
@endcomponent

