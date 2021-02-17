@component('mail::message')
# Contact Us Message

<h3>Name: </h3><p>{{$data['name']}}</p>
<h3>Email: </h3><p>{{$data['email']}}</p>
<h3>Message: </h3><p>{{$data['message']}}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
