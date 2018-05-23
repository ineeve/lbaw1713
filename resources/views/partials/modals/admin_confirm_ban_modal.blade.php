<div class="modal fade" id="banModal" tabindex="-1" role="dialog" aria-labelledby="banModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="banModalLabel">Ban User Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="banDescriptionForm">
              <div class="form-group">
                <label for="banDescriptionTextarea">Ban description</label>
                <textarea class="form-control" id="banDescriptionTextarea" rows="3" required></textarea>
              </div>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary float-right">Confirm</button>
            </form>
          </div>
        </div>
      </div>
</div>