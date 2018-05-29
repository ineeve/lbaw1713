@if(Auth::check()) @include('partials/report_modal',$reportReasons)
<meta name="news_id" content="{{$news->id}}"> @else @include('partials/modals/login_modal') @endif
<script src="{{ asset('js/scrollComment.js') }}" defer></script>
  <div id="newsContent" class="tab-content">
    <div class="tab-pane fade active show" id="article">
      <div class="container mt-4">
        <div class="row">
          <!-- ARTICLE OPTIONS -->
          <!-- TODO: ADD moderetor option -->
          <div class="col-12 col-md-1 px-0">
            <div name="newsOptions">
              <div class="d-flex flex-md-column justify-content-center flex-row align-items-center mt-md-5" name="vote" title="Use to vote on the news" style="font-size:1.5em">
                @if (Auth::check())
                <i class="fas fa-arrow-alt-circle-up fa-fw clickable-btn" id="upvote" onclick="upvote({{$news->id}})"></i>
                <span id="votesCounter" class="mx-2">{{ $news->votes }}</span>
                <i class="fas fa-arrow-alt-circle-down fa-fw clickable-btn" id="downvote" onclick="downvote({{$news->id}})"></i>
                @else
                <i class="fas fa-arrow-alt-circle-up fa-fw clickable-btn" id="upvote" data-toggle="modal" data-target="#loginModal"></i>
                <span id="votesCounter" class="mx-2">{{ $news->votes }}</span>
                <i class="fas fa-arrow-alt-circle-down fa-fw clickable-btn" id="downvote" data-toggle="modal" data-target="#loginModal"></i>
                @endif
              </div>

            @if (Auth::check() && Auth::user()->id == $news->author_id)
            <!-- Edit -->
            <div class="centerText mt-2 mt-md-4" name="edit" title="Use to edit this news">
              <a href="{{ url('news/'.$news->id.'/edit') }}" class="lightText">
                <span class="mr-md-1">Edit</span>
                <i class="fas fa-edit fa-fw clickable-btn"></i>
              </a>
            </div>
            <!-- Delete -->
            <div class="centerText mt-2" name="delete" title="Use to delete this news. If you are the author the news will be permantly deleted from our servers.">
              <form action="{{ route('delete_news', $news->id) }}" method="post" class="delete-news">
                {{ method_field('delete') }} {{ csrf_field() }}
                <span class="delete-news lightText" onMouseOver="this.style.textDecoration= 'underline';
                    this.style.color='#2780E3';
                    this.style.cursor='pointer';" onMouseOut="this.style.textDecoration= 'none';
                    this.style.color='initial';">
                  <span class="mr-md-1">Delete</span>
                  <i class="fas fa-times fa-fw clickable-btn"></i>
                </span>
                <script>
                  $('span.delete-news').click(function () {
                    $('form.delete-news').submit();
                  })
                </script>
              </form>
            </div>
            @else @if (Auth::check())
            <!-- Report -->
            <div data-toggle="modal" data-target="#reportModal" title="Use to report this news. The report will be analysed by our team of moderators.">
              <div class="centerText mt-4">
                <a href="#reportModal"><span class="lightText mr-md-1">Report</span><i class="fas fa-ban fa-fw clickable-btn" data-toggle="modal" data-target="#reportModal"></i></a>
              </div>

            </div>
            @if(Auth::user()->permission == 'admin' || Auth::user()->permission ==  'moderator')
            <!-- TODO: ver metodo delete para admin e moderadores -->
            <div class="centerText mt-2" name="delete" title="Use to delete this news. If you are the author the news will be permantly deleted from our servers.">
              <form action="{{ route('delete_news', $news->id) }}" method="post" class="delete-news">
                {{ method_field('delete') }} {{ csrf_field() }}
                <span class="delete-news lightText" onMouseOver="this.style.textDecoration= 'underline';
                    this.style.color='#2780E3';
                    this.style.cursor='pointer';" onMouseOut="this.style.textDecoration= 'none';
                    this.style.color='initial';">
                  <span class="mr-md-1">Delete</span>
                  <i class="fas fa-times fa-fw clickable-btn"></i>
                </span>
                <script>
                  $('span.delete-news').click(function () {
                    $('form.delete-news').submit();
                  })
                </script>
              </form>
            </div>
            @endif
            @else
            <span data-toggle="modal" data-target="#loginModal">
              <div class="centerText mt-4">
                <span class="lightText mr-md-2">Report</span>
                <i class="fas fa-ban fa-fw clickable-btn" data-toggle="modal" data-target="#loginModal"></i>
              </div>
            </span>
            @endif @endif


          </div>
        </div>
        <!-- ARTICLE -->
        <div class="col-12 col-md-11 mt-3 article px-10">
          <script type="text/javascript">
            var news_id = "{{ $news->id }}"; //TODO get from route
          </script>
          <h1 class="title bold"> {{ $news->title }}</h1>
          <a class="nounderline" style="color:inherit;" href="{{ url('users/'.$news->author) }}">
            <h5 class="author">Author: {{ $news->author }}</h5>
          </a>
          <h6 class="category">Category: {{ $news->section }}</h6>
          <h6 class="date"> {{ date("F jS, Y \a\\t H:i", strtotime($news->date)) }}</h6>
          <div class="body">
            {!! $news->body !!}
          </div>
          <div id="sourcesDiv" class="mt-4">
            <h5>Sources</h5>
            @foreach ($sources as $source)
            <p>
              @if($source->author) {{$source->author}}, @endif @if($source->publication_year) {{$source->publication_year}} - @endif
              <a href="{{ $source->link }}"> {{ $source->link }}</a>
            </p>
            @endforeach
          </div>

          <h3 class="mt-4">Comments</h3>
          <form class="mt-3 mb-4" method="POST" action="{{ route('comments.store', $news->id) }}">
            {{ csrf_field() }}
            <div class="form-group">
              <textarea class="form-control" name="text" id="text" rows="3" placeholder="Comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post</button>
          </form>
          <div class="row" id="placeComments">
          </div>
          <span class="comment"> @include('partials.load_more',['hide'=>false]) </span>
        </div>
      </div>
    </div>
  </div>
</div>