<nav aria-label="...">

<ul id="profile_following_pag" class="pagination">
    <li class="page-item" value='1'>
        <a class="page-link" href="#" data-value="first">First</a>
    </li>
    @if(floor($following_offset/5 + 1)<5)
        @for($i=1;$i<floor($following_offset/5 + 1);$i++)
        <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" data-value={{$i}}>{{$i}} </a>
        </li>
        @endfor
    @else
        <li class="page-item disabled">
            <span class="page-link">...</span>
        </li>
        @for($i=floor($following_offset/5 + 1)-3;$i< floor($following_offset/5 + 1);$i++)
        <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" data-value={{$i}}>{{$i}}</a>
        </li>
        @endfor
    @endif
        <li class="page-item active" value={{$i}}>
            <a class="page-link" href="#" data-value={{$i}}>{{floor($following_offset/5 + 1)}}</a>
        </li>
        @for($i=floor($following_offset/5 + 1)+1;$i< floor($following_offset/5 + 1)+4&&$i<=$following_count;$i++) 
            <li class="page-item" value={{$i}}>
            <a class="page-link" href="#" data-value={{$i}}>{{$i}}</a>
            </li>
        @endfor 
            @if(floor($following_offset/5 + 1)+4 <= $following_count)
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            @endif
            <li class="page-item" value={{$following_count}}>
                <a class="page-link" href="#" data-value='last'>Last</a>
            </li>
</ul>
</nav>