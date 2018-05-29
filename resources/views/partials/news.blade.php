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
                @if ($currentSection === 'For You')
                  <i class="fas fa-heart"></i> For You
                @else
                  <i class="fas fa-bullseye"></i> All
                @endif
              </h1>
              <!-- Sort News Dropdown -->
              @include('partials.sort_news_dropdown')
            </div>
          </div>
          <div id="news_item_preview_list" class="d-flex flex-column">
            @include('partials.news_item_preview_list',$news)
          </div>
          <span class="previews"> @include('partials.load_more', ['hide'=>(count($news)==0)]) </span>
        </div>
      </div>
    </div>
  </div>
</div>