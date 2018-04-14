<div class="news_box border container ml-0 my-2">
    <div class="row" style="position:relative;">
        <div class="col col-sm-auto my-2">
            <img src="{{ asset('storage/news/'.$item->image) }}" width="100px" height="100px" alt="Icon">
        </div>
        <div class="col">
            <div class="row">
                <a class="nounderline" style="color:inherit;" href="{{ url('news/'.$item->id) }}">
                    <h3 class="font-weight-normal">{{ $item->title }}</a>
            </div>
            <div class="row">
                <p>
                    <span class="font-weight-bold">{{ $item->votes }} votes</span> &middot; {{ $item->author }} &middot; {{ date('d-m-Y', strtotime($item->date))  }}</p>
            </div>
            <div class="row">
                <p>{!! $item->body_preview !!}</p>
            </div>
        </div>
    </div>
</div>