@if(Auth::check())
  @include('partials/report_modal')
  <meta name="news_id" content="{{$news->id}}">
@else
  @include('partials/login_modal')
@endif
<script src="{{ asset('js/scrollComment.js') }}" defer></script>
  <div id="newsContent" class="tab-content">
    <div class="tab-pane fade active show" id="article">
      <div class="container mt-4">
        <div class="row">
          <!-- ARTICLE OPTIONS -->
          <div class="col-12 col-md-1 px-0">
            <div name="newsOptions" title="Vote and manage this news">
              <div class="d-flex flex-md-column justify-content-center flex-row align-items-center mt-md-5" name="vote" title="Use to vote on the news" style="font-size:1.5em">
                @if (Auth::check())
                <i class="fas fa-arrow-alt-circle-up clickable-btn" id="upvote" onclick="upvote({{$news->id}})"></i>
                <span id="votesCounter" class="mx-2">{{ $news->votes }}</span>
                <i class="fas fa-arrow-alt-circle-down clickable-btn" id="downvote" onclick="downvote({{$news->id}})"></i>
                @else
                <i class="fas fa-arrow-alt-circle-up clickable-btn" id="upvote" data-toggle="modal" data-target="#loginModal"></i>
                <span id="votesCounter" class="mx-2">{{ $news->votes }}</span>
                <i class="fas fa-arrow-alt-circle-down clickable-btn" id="downvote" data-toggle="modal" data-target="#loginModal"></i>
                @endif
              </div>

              @if (Auth::check() && Auth::user()->id == $news->author_id)
              <!-- Edit -->
              <div class="centerText mt-2 mt-md-4" name="edit" title="Use to edit this news">
                <a href="{{ url('news/'.$news->id.'/edit') }}" class="lightText">
                  <span class="mr-md-1">Edit</span> 
                  <i class="fas fa-edit clickable-btn"></i>
                </a>
              </div>
              <!-- Delete -->
              <div class="centerText mt-2" name="delete" title="Use to delete this news. The news will still be stored in our servers but will not be visible for any user.">
                <form action="{{ route('delete_news', $news->id) }}" method="post" class="delete-news">
                  {{ method_field('delete') }}
                  {{ csrf_field() }}
                  <span class="delete-news" 
                    onMouseOver="this.style.textDecoration= 'underline';
                    this.style.color='#2780E3';
                    this.style.cursor='pointer';"
                    onMouseOut="this.style.textDecoration= 'none';
                    this.style.color='initial';">
                    <span class="lightText mr-md-1">Delete</span>
                    <i class="fas fa-times clickable-btn"></i>
                  </span>
                  <script>
                    $('span.delete-news').click(function() {
                      $('form.delete-news').submit();
                    })
                  </script>
                </form>
              </div>
              @else
                @if (Auth::check())
                  <!-- Report -->
                  <span data-toggle="modal" data-target="#reportModal">
                    <div class="centerText mt-4">
                      <span class="lightText mr-md-2">Report</span>
                       <i class="fas fa-ban clickable-btn" data-toggle="modal" data-target="#reportModal"></i>
                    </div>
                    
                  </span>
                @else
                <span data-toggle="modal" data-target="#loginModal">
                  <div class="centerText mt-4">
                      <span class="lightText mr-md-2">Report</span>
                      <i class="fas fa-ban clickable-btn" data-toggle="modal" data-target="#loginModal"></i>
                  </div> 
                </span>
                @endif
              @endif


            </div>            
          </div>
          <!-- ARTICLE -->
          <div class="col-12 col-md-11 mt-3 article px-10">
          <script type="text/javascript">
            var news_id = "{{ $news->id }}";//TODO get from route
          </script> 
            <h1 class="title bold"> {{ $news->title }}</h1>
            <h5 class="author">Author: {{ $news->author }}</h6>
            <h6 class="category">Category: {{ $news->section }}</h6>
            <h6 class="date"> {{ date("F jS, Y \a\\t H:i", strtotime($news->date)) }}</h6>
            <div class="body">
                {!! $news->body !!}
            </div>
            <div id="sourcesDiv" class="mt-4">
              <h5>Sources</h5>
              @foreach ($sources as $source)
                  <p>
                  @if($source->author)
                    {{$source->author}},
                  @endif
                  @if($source->publication_year)
                    {{$source->publication_year}} -
                  @endif
                  <a href="{{ $source->link }}"> {{ $source->link }}</a></p>
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
            <div class="row">
            <div class="col">
                <a id="scrollComment" href="#" class="loadMore" style="text-decoration: none;">Show More</a>
              </div>
              <div class="col text-right">
                <p class="totop">
                  <a style="text-decoration: none;" href="#top">Back to top</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
