<!-- <ul class="pagination">
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
</ul> -->

<nav aria-label="...">

<ul id="profile_following_pag" class="pagination">
    <li class="page-item" value='1'>
        <a class="page-link" href="#" value="first">First</a>
    </li>
    @if(floor($following_offset/5 + 1)<5)
        @for($i=1;$i<floor($following_offset/5 + 1);$i++)
        <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" value={{$i}}>{{$i}} </a>
        </li>
        @endfor
    @else
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        @for($i=floor($following_offset/5 + 1)-3;$i< floor($following_offset/5 + 1);$i++)
        <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" value={{$i}}>{{$i}}</a>
        </li>
        @endfor
    @endif
        <li class="page-item active" value={{$i}}>
            <a class="page-link" href="#" value={{$i}}>{{floor($following_offset/5 + 1)}}</a>
        </li>
        @for($i=floor($following_offset/5 + 1)+1;$i< floor($following_offset/5 + 1)+4&&$i<=$following_count;$i++) 
            <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" value={{$i}}>{{$i}}</a>
            </li>
        @endfor 
            @if(floor($following_offset/5 + 1)+4 <= $following_count)
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            @endif
            <li class="page-item" value={{$following_count}}>
                <a class="page-link" href="#" value='last'>Last</a>
            </li>
</ul>
</nav>