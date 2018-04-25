<script src="{{ asset('js/profile.js') }}" defer></script>
<div class="container-fluid">

  <div class="row">

    <div class="col-lg-3 col-12 mx-0">

      <div class="border border-top-0 border-left-0 border-right-0 profile_item container p-2 mx-auto mt-3">


        <div class="row">
          <div clas="col">
            <a href="profile_edit.html">

              <div class="ml-3 mt-1 d-flex flex-row align-items-center">
                <i class="fa fa-edit"></i>
                <h5 class="ml-2 mt-2">Edit Profile</h5>
              </div>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <img class="img-responsive" src="{{ Storage::url('users/'.($user->picture == null ? 'default' : $user->picture)) }}" alt="pic" height="200px"
              width="200px">
          </div>

        </div>

        <div class="row">

          <div class="col">

            <h4 class="font-weight-bold mt-2">{{ $user->username }}</h4>
            <h4>
              <span class="badge badge-secondary">{{ $user->points }} points</span>
            </h4>
            <p class="mb-0">{{ $user->gender }}
            </p>
            <p class="mb-0">{{ $user->country }}
            </p>
            <p class="mb-0">{{ $user->email }}
            </p>

          </div>
        </div>

      </div>
      <div class="p-2 mt-3 container">
        <h3>Last badges earned
          <span class="badge badge-secondary">{{ count($achieved_badges) }} / {{ $total_badges }}</span>
        </h3>
        <!-- Badges Modal -->
        <div class="modal fade" id="badgesModal" tabindex="-1" role="dialog" aria-labelledby="badgesModalLabel" style="display: none;"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="badgesModalLabel">All Badges</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body d-flex justify-content-around flex-wrap" style="height:auto;">
                @if ($achieved_badges != null) @include('partials.badge_list',$achieved_badges) @endif
              </div>
            </div>
          </div>
        </div>

        <div class="d-flex flex-wrap flex-row mx-auto mt-3" data-toggle="modal" data-target="#badgesModal" style="cursor:pointer">
          @if ($achieved_badges != null)
          <?php 
              $max = 6;
              if(count($achieved_badges) < 6) {
                $max = count($achieved_badges);
              }
              for ($x = 0; $x < $max; $x++) {?>

          <div class="badge">
            <img alt="Icon" src="http://icons.iconarchive.com/icons/seanau/fresh-web/128/Badge-icon.png" width="80" height="80">
            <h3>
              <?= $achieved_badges[$x]->name ?>
            </h3>
            <p>
              <?= $achieved_badges[$x]->brief ?>
            </p>
          </div>

          <?php } ?> @endif

        </div>

      </div>
    </div>

    <div class="col-lg-8 col-12 mt-3 mx-2">
      <div class="row h-50 d-flex flex-column mx-auto">
        <h2 class="container pl-0">Articles</h2>
        <div id="my_articles">
          @if ($news != null) @include('partials.news_item_preview_list',$news) @endif
        </div>
        <!-- <div class="row">
          <div class="col">
            <a href="#" class="loadMore" style="text-decoration: none; display: none;">Show More</a>
          </div>
          <div class="col text-right">
            <p class="totop">
              <a style="text-decoration: none; display: none;" href="#top">Back to top</a>
            </p>
          </div>
        </div> -->
        <ul class="pagination">
          <li class="page-item mx-2">
            @if($offset == 0)
            <i class="fas fa-2x fa-angle-left clickable-btn" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
            @else
            <i class="fas fa-2x fa-angle-left clickable-btn clickable" id="previous_articles" onclick="getPreviousArticles( '{{ $user->username }}' )"></i>
            @endif
          </li>
          <li class="page-item mx-2">
            @if($count == 0)
            <i class="fas fa-2x fa-angle-right clickable-btn" id="next_articles" onclick="getNextArticles( '{{ $user->username }} )"></i>
            @else
            <i class="fas fa-2x fa-angle-right clickable-btn clickable" id="next_articles" onclick="getNextArticles( '{{ $user->username }}' )"></i>
            @endif
          </li>
        </ul>
      </div>
      <div class="row h-50 d-flex flex-column mx-auto">
        <h2 class="container pl-0">Following</h2>
      </div>
    </div>

  </div>
</div>
