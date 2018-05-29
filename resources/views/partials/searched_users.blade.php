<script src="{{ asset('js/scrollAdvancedSearch.js') }}" defer></script>

<input id="user_advanced_search" type="hidden" value="{{$searchText}}">
<div class="container">
  <div id="users">
    <div class="row mt-2">
      <div class="container d-flex justify-content-between">
        <h1 id="searchedText" ><i class="fas fa-search fa-fw"></i> {{$searchText}}</h1>
      </div>
    </div>
    <div class="d-flex flex-column">
      <div id="users_item_preview_list" class="d-flex flex-wrap flex-row mx-auto mt-3">
        @if (isset($users) && count($users) > 0) @foreach($users as $user) @include('partials.users_item_preview_list',[$user]) @endforeach
        @else
        <hr>
        <h4>Sorry, no users matched your search. Try with different keywords or with advanced search.</h4>
        @endif
      </div>
      @if(isset($users) && count($users) > 0)
      <div class="container ml-0">
        <button id="scroll_advanced_search_users" type="button" class="btn btn-light btn-lg btn-block loadMore">Show More</button>
        <button type="button" class="btn btn-secondary btn-lg btn-block" onclick="location.href='#top'">Back To top</button>
      </div>
      @endif
    </div>
  </div>
</div>