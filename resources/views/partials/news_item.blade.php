<script src="{{ asset('js/scroolComment.js') }}" defer></script>
  <div id="myTabContent" class="tab-content">
    <div class="tab-pane fade active show" id="article">
      <div class="container-fluid">
        <div class="row">
          <!-- ARTICLE OPTIONS -->
          <div class="col-1 pr-0">
            <div class="d-flex flex-column mt-5 justify-content-end">
            <div class="d-flex flex-row justify-content-end">
              <span class="mt-2 mr-2"> {{ $news->votes }}</span>
              <div class="d-flex flex-column">
                <i class="fas fa-arrow-alt-circle-up clickable-btn"></i>
                <i class="fas fa-arrow-alt-circle-down mt-2 clickable-btn"></i> 
              </div>
            </div>
            <div class="d-flex flex-row justify-content-end mt-2"> 
              @if (Auth::check() && Auth::user()->id == $news->author_id)
                  <div class="d-flex flex-column justify-content-end">
                    <!-- Edit -->
                    <div class="d-flex flex-row justify-content-end">
                      <a href="{{ url('news/'.$news->id.'/edit') }}" style="color: inherit;">
                        <span class="mr-2">Edit</span> 
                      </a>
                      <i class="fas fa-edit clickable-btn mt-1"></i>
                    </div>
                    <!-- Delete -->
                    <div class="d-flex flex-row justify-content-end"><span class="mt-1 mr-2">Delete</span> <i class="fas fa-times mt-2 clickable-btn"></i></div>
                  </div>
              @else
                  <!-- Report -->
                  <span class="mt-1 mr-2">Report</span> <i class="fas fa-ban mt-2 clickable-btn" data-toggle="modal" data-target="#reportModal"></i>
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
              <!-- TODO: change alt -->
              <img class="img-fluid mx-auto my-3 d-block" src="{{ asset('storage/news/'.$news->image) }}" alt="{{$news->image}}"
               width="460" height="345">
              <div class="body">
                  {!! $news->body !!}
              </div>
              <h4>Sources</h4>
                @foreach ($sources as $source)
                  <a href="{{ $source->link }}">{{ $source->link }}</a>
                @endforeach
              <h3 class="mt-4">Comments</h3>
              <form class="mt-3 mb-4">
                <div class="form-group">
                  <textarea class="form-control" id="self-comment" rows="3" placeholder="Comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Post</button>
              </form>
              <div class="row" id="placeComments">
              </div>
              <div class="row">
              <div class="col">
                  <a id="scroolComment" href="#" class="loadMore" style="text-decoration: none;">Show More</a>
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
