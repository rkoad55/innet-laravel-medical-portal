@component('mail::message')
# Hello {{$patient['name']}},
<br>
Thank you for Signing up! We just need you to verify your email address to complete setting up your account. 


@component('mail::button', [
    'url' => url('/confirm-patient/' . $patient['hash'].'-'.date('y-m-d-'.$patient['id'].'-H-i-s')),
    'color' => 'red'
    ])
    Verify
    @endcomponent
    
    {{--dd($patient)--}}
Thanks,<br>
iNETT.
@endcomponent