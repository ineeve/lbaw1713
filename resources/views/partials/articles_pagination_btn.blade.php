<ul class="pagination">
    <li class="page-item mx-2">
        @if($offset == 0)
        <i class="fas fa-2x fa-angle-left clickable-btn" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
        @else
        <i class="fas fa-2x fa-angle-left clickable-btn clickable" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
        @endif
    </li>
    <li class="page-item mx-2">
        @if($count
        <=0 ) <i class="fas fa-2x fa-angle-right clickable-btn" id="next_articles" onclick="getNextArticles( '{{ $user->username }} )"></i>
            @else
            <i class="fas fa-2x fa-angle-right clickable-btn clickable" id="next_articles" onclick="getNextArticles( '{{ $user->username }}' )"></i>
            @endif
    </li>
</ul>