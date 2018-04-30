<ul class="pagination">
    <li class="page-item mx-2">
        @if($following_offset == 0)
        <i class="fas fa-2x fa-angle-left clickable-btn" id="previous_following" onclick="getPreviousFollowing( '{{ $user->username }}' )"></i>
        @else
        <i class="fas fa-2x fa-angle-left clickable-btn clickable" id="previous_following" onclick="getPreviousFollowing( '{{ $user->username }}' )"></i>
        @endif
    </li>
    <li class="page-item mx-2">
        @if($following_count
        <=0 ) <i class="fas fa-2x fa-angle-right clickable-btn" id="next_following" onclick="getNextFollowing( '{{ $user->username }} )"></i>
            @else
            <i class="fas fa-2x fa-angle-right clickable-btn clickable" id="next_following" onclick="getNextFollowing( '{{ $user->username }}' )"></i>
            @endif
    </li>
</ul>