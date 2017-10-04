@if (Auth::user()->is_bookmarking($id))
    {!! Form::open(['route' => ['user.unbookmark', $id], 'method' => 'delete']) !!}
        {!! Form::submit('Unbookmark', ['class' => "btn btn-danger btn-xs"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['user.bookmark', $id]]) !!}
        {!! Form::submit('Bookmark', ['class' => "btn btn-primary btn-xs"]) !!}
    {!! Form::close() !!}
@endif
