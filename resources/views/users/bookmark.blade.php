@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>☆BOOKMARK☆</h1>
        <div class="col-xs-8">
            @if (count($bookmarkings) > 0)
                @include('bookmark.bookmarkings', ['bookmarkings' => $bookmarkings])
            @endif
        </div>
    </div>
@endsection