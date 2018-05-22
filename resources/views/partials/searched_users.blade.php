<div class="container">
      <div id="news">
        <div class="row mt-2">
          
        </div>
        <div class="d-flex flex-column">
            <div id="news_item_preview_list">
              @if (isset($news) && count($news) > 0)
                @foreach($users as $user)
                @include('partials.users_item_preview_list',$user)
                @endforeach
              @else
                <hr>
                <h4>Sorry, no news matched your search. Try with different keywords or with advanced search.</h4>
              @endif
            </div>
            @if(isset($news) && count($news) > 0)
              @include('partials.load_more')
            @endif
          </div>
      </div>
  </div>