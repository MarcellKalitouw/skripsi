<div>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success" id="alert" role="alert">
            <strong>Success - </strong> {!! $message !!}
        </div>
    @elseif ($message = Session::get('error'))
        <div class="alert alert-danger" id="alert" role="alert">
            <strong>Error - </strong> {!! $message !!}
        </div>
    @endif

</div>
