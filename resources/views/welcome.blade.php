@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-md-4">
                {!! Form::open(['route' => 'microposts.store','files' => true]) !!}
                    <div class="form-group">
                        {!! Form::label('text', '☆ テキストを入力してください', ['class' => 'control-label']) !!}
                        {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows' => '5']) !!}
                        
                        <p>{!! nl2br("") !!}</p>

                        {!! Form::label('file', '☆ 画像を選択してください（任意）', ['class' => 'control-label']) !!}
                        {!! Form::file('photo') !!}
                    </div>
                    {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}

                <p>{!! nl2br("") !!}</p>

                <div>
                    {!! Form::open(['route' => ['users.bookmark', Auth::user()->id], 'method' => 'get']) !!}
                        {!! Form::submit('Show Bookmark', ['class' => "btn btn-info btn-block"]) !!}
                    {!! Form::close() !!}
                </div>
            </aside>
            <div class="col-xs-8">
                @if (count($microposts) > 0)
                    @include('microposts.microposts', ['microposts' => $microposts])
                @endif
            </div>
        </div>
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Microposts</h1>
                    {!! link_to_route('signup.get', 'Sign up now!', null, ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection