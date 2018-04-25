<div class="container">
    <div class="row mt-2">
      <div id="news">
        <div class="row">
          <div class="container d-flex justify-content-between">
            <h1 id="searchedText" >{{$searchText}}</h1>

            <!-- Sort News Dropdown -->
            @include('partials.sort_news_dropdown')
          </div>

        </div>
        <div class="d-flex flex-column">
          @include('partials.news_item_preview_list',$news)
        </div>
      </div>
    </div>
  </div>