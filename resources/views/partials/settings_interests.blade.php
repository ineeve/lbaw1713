<div class="tab-pane fade active show" id="interests">
  <h3>Manage Interests</h3>
  <h4 class="pt-3">Add A New Interest</h4>
  <form class="form-inline pb-3" method="POST" action="{{ route('add_interest') }}">
    {{ csrf_field() }}
    <label class="sr-only" for="interest_list">Interest</label>
    <select id="interest_list" name="interest_id" class="form-control">
      @foreach($sections as $section)
        <option value="{{ $section->id }}">{{ $section->name }}</option>
      @endforeach
    </select>
    <input class="btn ml-2" value="Add" type="submit">
  </form>
  <div class="list-group">
    @foreach($userSections as $section)
      <a href="" class="remove_section list-group-item list-group-item-action" section-id="{{ $section->id }}">
        {{ $section->name }}
        <div class="float-right">X</div>
      </a>
    @endforeach
  </div>
</div>