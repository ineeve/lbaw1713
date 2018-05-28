<nav id="navComments" aria-label="...">
                <ul class="pagination">
                    <li class="page-item" data-value='1'>
                        <a class="page-link" href="#">First</a>
                    </li>
                    @if($currentPageComments<5)
                        @for($i=1;$i<$currentPageComments;$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        @for($i=$currentPageComments-3;$i<$currentPageComments;$i++)
                        <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @endif
                        <li class="page-item active" data-value={{$i}}>
                            <a class="page-link" href="#">{{$currentPageComments}}</a>
                        </li>
                        @for($i=$currentPageComments+1;$i<$currentPageComments+4&&$i<=$numberOfPagesComments;$i++) 
                            <li class="page-item" data-value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                            </li>
                        @endfor 
                            @if($currentPageComments+4 <= $numberOfPagesComments)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                            <li class="page-item" data-value={{$numberOfPagesComments}}>
                                <a class="page-link" href="#">Last</a>
                            </li>
                </ul>
            </nav>