<script src="{{ asset('js/scrollAdvancedSearch.js') }}" defer></script>

<input id="user_advanced_search" type="hidden" value="{{$searchText}}">
<div class="container">
  <div id="users">
    <div class="row mt-2">

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
      <div class="row">
        <div class="col">
          <a id="scroll_advanced_search_users" href="#" class="loadMore" style="text-decoration: none;">Show More</a>
        </div>
        <div class="col text-right">
          <p class="totop">
            <a style="text-decoration: none;" href="#top">Back to top</a>
          </p>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>