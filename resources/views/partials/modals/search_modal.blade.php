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
        <form action="{{route('advanced_search')}}" method="get">
          <div class="form-group">
            <label for="advancedsearch-searchText">Search Text *</label>
            <input id="advancedsearch-searchText"type="text" class="form-control" placeholder="Search" name="searchText">
          </div>
          <div class="form-group my-1">
            <select class="custom-select" name="elementToSearch">
              <option value="titleAndBody" selected>Search for...</option>
              <option value="onlyTitle">Only title</option>
              <option value="onlyBody">Only body</option>
              <option value="titleAndBody">Title and body</option>
              <option value="username">Username</option>
            </select>
          </div>
          <div class="form-group my-1">
            <select name="sectionSearch" class="custom-select">
              <option value="">All</option>
              @foreach($sections as $section)
              <option value="{{ $section->id }}">{{ $section->name }}</option>
              @endforeach
            </select>
          </div>
          <input type="text" name="authorSearch" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="News' Author...">
          <div class="d-flex">
            <div class="form-group">
              <!-- <p><time></time></p> -->
              <label class="col-form-label">Begin:</label>
              <input type="date" name="date1" class="form-control" value="1990-01-01">
            </div>
            <div class="form-group">
              <!-- <p><time></time></p> -->
              <label class="col-form-label">End:</label>
              <input type="date" name="date2" class="form-control" value="2018-03-15">
            </div>
          </div>
          <button type="submit" class="btn btn-primary float-right">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>