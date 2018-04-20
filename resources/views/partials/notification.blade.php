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
    <?php
        function when($datetime) {   
            define("SECOND", 1);
            define("MINUTE", 60 * SECOND);
            define("HOUR", 60 * MINUTE); define("DAY", 24 * HOUR);
            define("MONTH", 30 * DAY); $delta = time() - strtotime($datetime);

            // convert
            if($delta < 1 * MINUTE) { return $delta == 1 ? "one second ago" : $delta." seconds ago"; }
            if($delta < 2 * MINUTE) { return "a minute ago"; } if($delta < 45 * MINUTE) { return floor($delta / MINUTE)." minutes ago"; }
            if($delta < 90 * MINUTE) { return "an hour ago"; } if($delta < 24 * HOUR) { return floor($delta / HOUR)." hours ago"; }
            if($delta < 48 * HOUR) { return "yesterday"; } if($delta < 30 * DAY) { return floor($delta / DAY)." days ago"; }
            if($delta < 12 * MONTH) { $months = floor($delta / DAY / 30); return $months <= 1 ? "one month ago" : $months." months ago"; }
            else { $years = floor($delta / DAY / 365); return $years <= 1 ? "one year ago" : $years." years ago"; }
        }

        echo when($notification->date);
    ?>
</a>