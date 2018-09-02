{{-- @if(count($errors) > 0 )
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">
            {!! $error !!}
                </div>
@endforeach
@endif --}}

@if(session('success'))
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
        <strong>
            {!! session('success') !!}
        </strong>        
    </div>
@endif

@if(session('error'))
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger">
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <strong>
                {!! $error !!}
                </strong>
            </div>
        @endforeach
    @else
        <div class='alert alert-danger'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <strong>
            {!! session('error') !!}
            </strong>
        </div>
    @endif
@endif