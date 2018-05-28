<nav aria-label="...">

                <ul id="profile_articles_pag" class="pagination">
                    <li class="page-item" data-value='1'>
                        <a class="page-link" href="#" data-value="first">First</a>
                    </li>
                    @if(floor($articles_offset/5 + 1)<5)
                        @for($i=1;$i<floor($articles_offset/5 + 1);$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#" data-value={{$i}}>{{$i}} </a>
                        </li>
                        @endfor
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        @for($i=floor($articles_offset/5 + 1)-3;$i< floor($articles_offset/5 + 1);$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#" data-value={{$i}}>{{$i}}</a>
                        </li>
                        @endfor
                    @endif
                        <li class="page-item active" data-value={{$i}}>
                            <a class="page-link" href="#" data-value={{$i}}>{{floor($articles_offset/5 + 1)}}</a>
                        </li>
                        @for($i=floor($articles_offset/5 + 1)+1;$i< floor($articles_offset/5 + 1)+4&&$i<=$articles_count;$i++) 
                            <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#" data-value={{$i}}>{{$i}}</a>
                            </li>
                        @endfor 
                            @if(floor($articles_offset/5 + 1)+4 <= $articles_count)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                            <li class="page-item" data-value={{$articles_count}}>
                                <a class="page-link" href="#" data-value='last'>Last</a>
                            </li>
                </ul>
            </nav>