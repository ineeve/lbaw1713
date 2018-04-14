<a class="dropdown-item" href="">
    <!-- TODO: add a link -->
    <i class="fas fa-user-circle">
    </i>
    @switch($notification->type)
    @case('FollowMe')
        {{ $notification->user()->get()[0]->username }} is following you! 
        @break
    @case('CommentMyPost')
        {{ $notification->user()->get()[0]->username }} commented in your post!
        @break
    @case('FollowedPublish')
        <!-- Todo: add -->
        {{ $notification->user()->get()[0]->username }} has posted new article!
        @break
    @case('VoteMyPost')
        <!-- Todo: add -->
        You have new votes in your article!
        @break
    @default
        Error: in notification.
    <!-- TODO: see -->
@endswitch
</a>