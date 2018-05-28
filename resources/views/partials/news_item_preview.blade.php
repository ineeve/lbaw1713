<div class="news_box border container ml-0 my-2">
    <div class="row" style="position:relative;">
        <div class="col col-sm-auto my-2">
            <img src="{{ asset('storage/news/'.$item->image) }}" width="100" height="100" alt="Icon">

        </div>
        <div class="col">
            <div class="row">
                <a class="nounderline" style="color:inherit;" href="{{ url('news/'.$item->id) }}">
                    <h3 class="font-weight-normal">{{ $item->title }}</h3></a>
            </div>
            <div class="row">
                <p>
                    <span class="font-weight-bold">{{ $item->votes }} votes</span> &middot; {{ $item->author }} &middot; {{ date("F jS, Y \a\\t H:i", strtotime($item->date))
                    }}
                </p>
            </div>
            <div class="row pr-4">
                {!! $item->body_preview !!}
            </div>
        </div>
    </div>
</div>