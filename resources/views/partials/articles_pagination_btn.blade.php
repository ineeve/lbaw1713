<!-- <ul class="pagination">
    <li class="page-item mx-2">
        @if($articles_offset == 0)
        <i class="fas fa-2x fa-angle-left clickable-btn" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
        @else
        <i class="fas fa-2x fa-angle-left clickable-btn clickable" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
        @endif
    </li>
    <li class="page-item mx-2">
        @if($articles_count
        <=0 ) <i class="fas fa-2x fa-angle-right clickable-btn" id="next_articles" onclick="getNextArticles( '{{ $user->username }} )"></i>
            @else
            <i class="fas fa-2x fa-angle-right clickable-btn clickable" id="next_articles" onclick="getNextArticles( '{{ $user->username }}' )"></i>
            @endif
    </li>
</ul> -->

<nav aria-label="...">

                <ul class="pagination">
                    <li class="page-item" value='1'>
                        <a class="page-link" href="#">First</a>
                    </li>
                    @if(floor($articles_offset/5 + 1)<5)
                        @for($i=1;$i<floor($articles_offset/5 + 1);$i++)
                        <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        @for($i=floor($articles_offset/5 + 1)-3;$i< floor($articles_offset/5 + 1);$i++)
                        <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @endif
                        <li class="page-item active" value={{$i}}>
                            <a class="page-link" href="#">{{floor($articles_offset/5 + 1)}}</a>
                        </li>
                        @for($i=floor($articles_offset/5 + 1)+1;$i< floor($articles_offset/5 + 1)+4&&$i<=$articles_count;$i++) 
                            <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                            </li>
                        @endfor 
                            @if(floor($articles_offset/5 + 1)+4 <= $articles_count)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                            <li class="page-item" value={{$articles_count}}>
                                <a class="page-link" href="#">Last</a>
                            </li>
                </ul>
            </nav>