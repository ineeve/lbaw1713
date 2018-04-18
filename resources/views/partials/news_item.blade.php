@if(Auth::check())
  @include('partials/report_modal')
  <meta name="news_id" content="{{$news->id}}">
@else
  @include('partials/register_modal')
@endif
<script src="{{ asset('js/scrollComment.js') }}" defer></script>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="article">
      <div class="container-fluid">
        <div class="row">
          <!-- ARTICLE OPTIONS -->
          <div class="col-1 pr-0">
            <div class="d-flex flex-column mt-5 justify-content-end">
            <div class="d-flex flex-row justify-content-end">
              <span id="votesCounter" class="mt-2 mr-2"> {{ $news->votes }}</span>
              <div class="d-flex flex-column">
                @if (Auth::check())
                <i class="fas fa-arrow-alt-circle-up clickable-btn" id="upvote" onclick="upvote({{$news->id}})"></i>
                <i class="fas fa-arrow-alt-circle-down mt-2 clickable-btn" id="downvote" onclick="downvote({{$news->id}})"></i>
                @else
                <i class="fas fa-arrow-alt-circle-up clickable-btn" id="upvote" data-toggle="modal" data-target="#registerModal"></i>
                <i class="fas fa-arrow-alt-circle-down mt-2 clickable-btn" id="downvote" data-toggle="modal" data-target="#registerModal"></i>
                @endif
              </div>
            </div>
            <div class="d-flex flex-row justify-content-end mt-2"> 
              @if (Auth::check() && Auth::user()->id == $news->author_id)
                  <div class="d-flex flex-column justify-content-end">
                    <!-- Edit -->
                    <div class="d-flex flex-row justify-content-end">
                      <a href="{{ url('news/'.$news->id.'/edit') }}" style="color: inherit;">
                        <span class="mr-2">Edit</span> 
                        <i class="fas fa-edit clickable-btn mt-1"></i>
                      </a>
                    </div>
                    <!-- Delete -->
                    <div class="d-flex flex-row justify-content-end">
                      <form action="{{ route('delete_news', $news->id) }}" method="post" class="delete-news">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <span class="delete-news">
                          <span class="mt-1 mr-2">Delete</span>
                          <i class="fas fa-times mt-2 clickable-btn"></i>
                        </span>
                        <script>
                          $('span.delete-news').click(function() {
                            $('form.delete-news').submit();
                          })
                        </script>
                      </form>
                    </div>
                  </div>
              @else
                @if (Auth::check())
                  <!-- Report -->
                  <span data-toggle="modal" data-target="#reportModal">
                    <span class="mt-1 mr-2">Report</span>
                    <i class="fas fa-ban mt-2 clickable-btn" data-toggle="modal" data-target="#reportModal"></i>
                  </span>
                @else
                <span data-toggle="modal" data-target="#registerModal">
                    <span class="mt-1 mr-2">Report</span>
                    <i class="fas fa-ban mt-2 clickable-btn" data-toggle="modal" data-target="#registerModal"></i>
                </span>
                @endif
              @endif
            </div>              
            </div>
          </div>
          <!-- ARTICLE -->
          <div class="col-11 col-lg-10 mt-3 article">
          <script type="text/javascript">
            var news_id = "{{ $news->id }}";//TODO get from route
          </script> 
            <h6 class="category"> {{ $news->section }}</h6>
              <h2 class="title"> {{ $news->title }}</h2>
              <h6 class="author"> {{ $news->author }} &middot; {{ date("F jS, Y \a\\t H:i", strtotime($news->date)) }}</h6>
              <div class="body">
                  {!! $news->body !!}
              </div>
              <h4>Sources</h4>
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
