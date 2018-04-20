<a class="dropdown-item" href="{{ url('notifications/'.$notification->id) }}">
    <i class="fas fa-user-circle">
    </i>
    @switch($notification->type)
        @case('CommentMyPost')
            {{ $notification->user()->get()[0]->username }} commented in your post!
            @break
        @case('FollowedPublish')
            {{ $notification->user()->get()[0]->username }} has posted new article!
            @break
        @case('VoteMyPost')
            You have new votes in your article!
            @break
        @case('FollowMe')
            {{ $notification->user()->get()[0]->username }} is following you! 
            @break
        @default
            Error: in notification.
    @endswitch
    {{ $notification->date }}
</a>