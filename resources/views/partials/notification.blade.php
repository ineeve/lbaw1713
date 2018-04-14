<a class="dropdown-item" href="#">
    <i class="fas fa-user-circle">
    </i>
    @if ($notification->type == 'FollowMe')
    {{ $notification->user()->get() }} is following you! 
    <!-- TODO: change from id to username -->
    @endif
</a>