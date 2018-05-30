<div class="mb-2">
  <div class="row">
    <div class="col-12 col-md-10">
      <h3>
        <i class="fas fa-chart-pie fa-fw"></i> Statistics</h3>
      <div id="stats">
        @include('partials.admin_stat_card', ['title' => 'Users', 'value' => $num_users])
        @include('partials.admin_stat_card', ['title' => 'Banned Users', 'value' => $num_bans])
        @include('partials.admin_stat_card', ['title' => 'News', 'value' => $num_news])
        @include('partials.admin_stat_card', ['title' => 'Comments', 'value' => $num_comments])
      </div>
    </div>
  </div>
</div>