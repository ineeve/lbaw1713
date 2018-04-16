<div class="container-fluid">
  <!-- SECOND ROW -->
  <div class="row mt-2">
    <!-- LEFT-SECTIONS -->

  @include('partials.section')
    <!-- MAIN CONTENT  -->
    <div class="col-lg-8 col-md-9 col-12">
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="allNews">
        @if ($errors->has('email'))
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {{ $errors->first('email') }} </strong>
            </div>
        @endif
        @if ($errors->has('password'))
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {{ $errors->first('password') }} </strong>
            </div>
        @endif
          <!-- NEWS -->
          <!-- News Header -->
          <div class="row">
            <div class="container ml-0 d-flex justify-content-between">
              <h1 class="current_section">
                <i class="fa fa-bullseye"></i> All</h1>
              <!-- Sort News Dropdown -->
              <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="d-flex">
                    <h5 class="sort-option">Most Popular </h5>
                    <i class="fas fa-chevron-down ml-2 mt-1"></i>
                  </div>
                </button>
                <div class="dropdown-menu order" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="#">Most Popular</a>
                  <a class="dropdown-item" href="#">Most Voted</a>
                  <a class="dropdown-item" href="#">Most Recent</a>
                </div>
              </div>
              <script>
                $(".order .dropdown-item").click(function (event) {
                  $(".sort-option").html($(this).text());
                });
              </script>
            </div>

          </div>
          <div class="d-flex flex-column">
            <div id="news_item_preview_list">
            @include('partials.news_item_preview_list',$news)
            </div>
            <div class="row">
              <div class="col">
                <a id="scrollNewsPreview" href="#scrollNewsPreview" class="loadMore" style="text-decoration: none;">Show More</a>
              </div>
              <div class="col text-right">
                <p class="totop">
                  <a style="text-decoration: none;" href="#top">Back to top</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>