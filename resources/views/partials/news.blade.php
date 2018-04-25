<script src="{{ asset('js/changeNewsCriteria.js') }}" defer></script>

<div class="container-fluid">
  <!-- SECOND ROW -->
  <div class="row mt-2">
    <!-- LEFT-SECTIONS -->
    @include('partials.section')

    <!-- MAIN CONTENT  -->
    <div class="col-lg-8 col-md-9 col-12">
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="allNews">
          <!-- NEWS -->
          <!-- News Header -->
          <div class="row">
            <div class="container ml-0 d-flex justify-content-between">
              <h1 class="current_section">
                <i class="fa fa-bullseye"></i> All
              </h1>
              <!-- Sort News Dropdown -->
              @include('partials.sort_news_dropdown')
            </div>

          </div>
          <div class="d-flex flex-column">
            <div id="news_item_preview_list">
              @if ($news != null) @include('partials.news_item_preview_list',$news) @endif
            </div>
            @include('partials.load_more')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>