<!-- ADVANCED SEARCH MODAL -->

<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="searchModalLabel">Advanced Search</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <div class="form-group my-1">
                <select class="custom-select">
                  <option selected>Search for...</option>
                  <option value="1">Only title</option>
                  <option value="2">Only body</option>
                  <option value="3">Title and body</option>
                  <option value="4">Username</option>
                </select>
              </div>
              <div class="form-group my-1">
                <select class="custom-select">
                  <option selected>Section...</option>
                  <option value="1">World</option>
                  <option value="2">Technology</option>
                  <option value="3">Science</option>
                  <option value="4">Business</option>
                  <option value="5">Sports</option>
                </select>
              </div>
              <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="News' Author...">
              <div class="d-flex">
                <div class="form-group">
                  <!-- <p><time></time></p> -->
                  <label class="col-form-label">Begin:</label>
                  <input type="date" class="form-control" value="1990-01-01">
                </div>
                <div class="form-group">
                  <!-- <p><time></time></p> -->
                  <label class="col-form-label">End:</label>
                  <input type="date" class="form-control" value="2018-03-15">
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Search</button>
            </form>
          </div>
        </div>
      </div>
</div>