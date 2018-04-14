<a class="dropdown-item" href="#">
    <i class="fas fa-user-circle">
    </i>
    @switch($notification->type)
    @case('FollowMe')
        {{ $notification->user()->get()[0]->username }} is following you! 
        @break
    @case('CommentMyPost')
        <!-- Todo: add -->
        @break
    @case('FollowedPublish')
        <!-- Todo: add -->
        @break
    @case('VoteMyPost')
        <!-- Todo: add -->
        @break
    @default
        Error: in notification.
    <!-- TODO: see -->
@endswitch
</a>