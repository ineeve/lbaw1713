<script src="{{ asset('js/collapsible.js') }}" defer></script>

<div class="col-md-3 col-12" id="sections">
      <div class="col-md-12 col-sm-6 col-12 p-0">
        <h3 data-toggle="collapse" data-target="#sections_list" aria-expanded="true" aria-controls="sections_list">
          <i class="fas fa-bars fa-fw"></i> Sections</h3>
        <div class="collapse show collapsible" id="sections_list">
          <ul class="nav nav-pills flex-column left-pane">
            <li class="nav-item">
              <a href="#" role="button" data-toggle="tab" data-name="For You" class="nav-link section_item {{ $currentSection == 'For You' ? 'active' : '' }}">
                <i class="fas fa-heart fa-fw"></i> For You</a>
            </li>
            <li class="nav-item">
              <a href="#" role="button" data-toggle="tab" data-name="All" class="nav-link section_item {{ $currentSection == 'All' ? 'active' : '' }}">
                <i class="fa fa-bullseye fa-fw"></i> All</a>
            </li>
            @foreach ($sections as $section)
              <li class="nav-item">
                <a href="#" data-name="{{ $section->name }}" role="button" data-toggle="tab" class="nav-link section_item">
                  <i class="{{ $section->icon }} fa-fw"></i> {{ $section->name }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
</div>