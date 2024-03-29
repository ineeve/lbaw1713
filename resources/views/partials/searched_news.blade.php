<script src="{{ asset('js/changeNewsCriteria.js') }}" defer></script>

<div class="container">
      <div id="news">
        <div class="row mt-2">
          <div class="container d-flex justify-content-between">
            <h1 id="searchedText" ><i class="fas fa-search fa-fw"></i> {{$searchText}}</h1>
          </div>
        </div>
        <div class="d-flex flex-column">
            <div id="news_item_preview_list">
              @if (isset($news) && count($news) > 0)
                @include('partials.news_item_preview_list',$news)
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