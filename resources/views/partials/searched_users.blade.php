<script src="{{ asset('js/changeNewsCriteria.js') }}" defer></script>

<div class="container">
      <div id="users">
        <div class="row mt-2">
          
        </div>
        <div class="d-flex flex-column">
            <div id="users_item_preview_list" class="d-flex flex-wrap flex-row mx-auto mt-3">
              @if (isset($users) && count($users) > 0)
                @foreach($users as $user)
                @include('partials.users_item_preview_list',[$user])
                @endforeach
              @else
                <hr>
                <h4>Sorry, no users matched your search. Try with different keywords or with advanced search.</h4>
              @endif
            </div>
            @if(isset($users) && count($users) > 0)
              @include('partials.load_more')
            @endif
          </div>
      </div>
  </div>