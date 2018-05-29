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
            <input type="text" name="name" placeholder="Name" class="form-control">
          </div>
          <div class="form-group">
            <input type="text" name="icon" placeholder="Icon" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Category</button>
        </div>
      </form>
    </div>
  </div>
</div>