<nav id="navNews" aria-label="...">
                <ul class="pagination">
                    <li class="page-item" data-value='1'>
                        <a class="page-link" href="#">First</a>
                    </li>
                    @if($currentPageNews<5)
                        @for($i=1;$i<$currentPageNews;$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        @for($i=$currentPageNews-3;$i<$currentPageNews;$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @endif
                        <li class="page-item active" data-value={{$i}}>
                            <a class="page-link" href="#">{{$currentPageNews}}</a>
                        </li>
                        @for($i=$currentPageNews+1;$i<$currentPageNews+4&&$i<=$numberOfPagesNews;$i++) 
                            <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                            </li>
                        @endfor 
                            @if($currentPageNews+4 <= $numberOfPagesNews)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                            <li class="page-item" data-value={{$numberOfPagesNews}}>
                                <a class="page-link" href="#">Last</a>
                            </li>
                </ul>
            </nav>