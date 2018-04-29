<div class="tab-pane fade active show" id="interests">
  <h3>Manage Interests</h3>
  <h4 class="pt-3">Add A New Interest</h4>
  <form class="form-inline pb-3">
    <input list="list_interests" name="interest" placeholder="Interest" class="form-control">
    <datalist id="list_interests">
      @foreach($sections as $section)
        <option name="{{ $section->id }}">{{ $section->name }}</option>
      @endforeach
    </datalist>
    <input class="btn ml-2" value="Add" type="submit">
  </form>
  <div class="list-group">
    @foreach($userSections as $section)
      <a href="" class="list-group-item list-group-item-action">{{ $section->name }}
        <div class="float-right">X</div>
      </a>
    @endforeach
  </div>
</div>