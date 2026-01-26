Hello <strong>{{ $name }}</strong>,
@if($type == 1)
<p>You request has been process, please check your email regularly for updates of your request.</p>
@elseif($type == 2)
<p>Your request has been approved.</p>
@else
<p>Your request has been rejected.</p>
@endif