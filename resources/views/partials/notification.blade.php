<a class="dropdown-item" href="#">
    <i class="fas fa-user-circle">
    </i>
    @if ($notification->type == 'FollowMe')
    {{$notification->user_id}} is following you! 
    <!-- TODO: change from id to username -->
    @endif
</a>