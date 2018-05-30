<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ route('add_category') }}">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label for="nameInput">Name *</label>
            <input id="nameInput" type="text" name="name" placeholder="Name" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="iconInput">Icon *</label>
            <input id="iconInput" type="text" name="icon" placeholder="Icon" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
        <div class="mx-2">* Field is required</div>
      </form>
    </div>
  </div>
</div>