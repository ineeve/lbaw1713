<div class="col-md-3 col-12" id="sections">
      <div class="col-md-12 col-sm-6 col-12 p-0">
        <h3 data-toggle="collapse" data-target="#sections_list" aria-expanded="true" aria-controls="sections_list">
          <i class="fas fa-bars"></i> Sections</h3>
        <div class="collapse" id="sections_list">
          <ul class="nav nav-pills flex-column left-pane">
            <li class="nav-item">
              <a href="#allNews" role="button" data-toggle="tab" class="nav-link active section_all">
                <i class="fa fa-bullseye"></i> All</a>
            </li>
            @foreach ($sections as $section)
              <li class="nav-item">
                <a href="#" name= {{ $section->name }} role="button" data-toggle="tab" class="nav-link section_specific">
                  <i class="{{ $section->icon }}"></i> {{ $section->name }}</a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>