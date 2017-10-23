<ul class="media-list">
@foreach ($bookmarkings as $bookmarking)
    <?php $user = $bookmarking->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email, 50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show', $user->name, ['id' => $bookmarking->user_id]) !!} <span class="text-muted">posted at {{ $bookmarking->created_at }}</span>
            </div>
            <div>
                <p>{!! nl2br(e($bookmarking->content)) !!}</p>
            </div>
            <div>
                <img src="{{ '/images/' . $bookmarking->filename }}" alt="" width="200px" height=auto>
            </div>
            <div>
                @include('bookmark.bookmark_button', ['id' => $bookmarking->id])
            </div>
        </div>
    </li>
@endforeach
</ul>
{!! $bookmarkings->render() !!}