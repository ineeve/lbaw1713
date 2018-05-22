<!-- REPORT MODAL -->
<div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span id="closeReportModal" aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="reportModalForm" method="post">
          <div id="reasonsGroup" class="form-group">
            <label>Reasons:</label>
            <div class="d-flex flex-wrap items-collection">
              @foreach ($reportReasons as $reason)
              <div class="mr-2 items">
                <div class="info-block block-info clearfix">
                  <div data-toggle="buttons" class="btn-group bizmoduleselect">
                    
                      <div class="itemcontent">
                      <label class="btn btn-primary">
                        <input class="no-display" type="checkbox" name="var_id[]" value="">
                        <h5>{{$reason}}</h5>
                        </label>

                      </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group">
            <label for="report-description-area">Description:</label>
            <textarea class="form-control" id="report-description-area" rows="3"></textarea>
          </div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>