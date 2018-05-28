<nav id="paginationNav" aria-label="...">
    <ul class="pagination">
        <li class="page-item" data-value='1'>
            <a class="page-link" href="#">First</a>
        </li>
        @if($currentPage<5)
            @for($i=1;$i<$currentPage;$i++)
            <li class="page-item" data-value={{$i}}>
                <a class="page-link" href="#">{{$i}}</a>
            </li>
            @endfor
        @else
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            @for($i=$currentPage-3;$i<$currentPage;$i++)
            <li class="page-item" data-value={{$i}}>
                <a class="page-link" href="#">{{$i}}</a>
            </li>
            @endfor
        @endif
            <li class="page-item active" data-value={{$i}}>
                <a class="page-link" href="#">{{$currentPage}}</a>
            </li>
            @for($i=$currentPage+1;$i<$currentPage+4&&$i<=$numberOfPages;$i++) 
                <li class="page-item" data-value={{$i}}>
                <a class="page-link" href="#">{{$i}}</a>
                </li>
            @endfor 
                @if($currentPage+4 <= $numberOfPages)
                <li class="page-item disabled">
                    <span class="page-link">...</span>
                </li>
                @endif
                <li class="page-item" data-value={{$numberOfPages}}>
                    <a class="page-link" href="#">Last</a>
                </li>
    </ul>
</nav>