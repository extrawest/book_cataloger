@if(session()->get('access_denied'))
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @if(is_array(json_decode(session()->get('access_denied'), true)))
            {{ implode('', session()->get('access_denied')->all(':message<br/>')) }}
        @else
            {{ session()->get('access_denied') }}
        @endif
    </div>
@endif