<script src="{{ asset('js/profile.js') }}" defer></script>
<div class="container-fluid">

  <div class="row">

    <div class="col-lg-3 col-12 mx-0">

      <div class="border border-top-0 border-left-0 border-right-0 profile_item container p-2 mx-auto mt-3">


        
        <div class="row">
          <div class="col">
            <img class="img-responsive" src="{{ Storage::url('users/'.($user->picture == null ? 'default' : $user->picture)) }}" alt="pic"
              height="200" width="200">
          </div>

        </div>
        <div class="row my-2">
          <div class="col">
            @if (Auth::check() && Auth::user()->username == $user->username)
            <a href="profile_edit.html">
              <div class="ml-3 mt-1 d-flex flex-row align-items-center">
                <i class="fa fa-edit"></i>
                <h5 class="ml-2 mt-2">Edit Profile</h5>
              </div>
            </a>

            @else
            <div id="following_btn">
              @if (Auth::check() && Auth::user()->following($user->username))
              <button type="button" class="btn btn-outline-primary" onclick="stopFollowing( '{{ $user->username }}' )">Following</button>
              @else
              @if(Auth::check())
              <button type="button" class="btn btn-primary" onclick="startFollowing( '{{ $user->username }}' )">Follow</button>
              @else
              @include('partials.modals.login_modal')
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Follow</button>
              @endif
              @endif
            </div> @endif

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
            @if (isset($user->country))
              <p class="mb-0">{{ $user->country }}
              </p>
            @endif
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
          @if ($achieved_badges != null) @foreach ($nth_badges as $badge) @include('partials.nth_badges',[$badge]) @endforeach @endif

        </div>

      </div>
    </div>
    <input id="user" type="hidden" value="{{$user->username}}">
     
    <div class="col-lg-8 col-12 mt-3 mx-2">
      <h2 class="w-100 pl-0 mb-3">Articles</h2>
      <div id="my_articles">
        @if ($news != null) @include('partials.news_item_preview_list',$news)
      </div>
      @if(!($articles_offset == 0 && $articles_count
      <=0 )) <div id="articles_pagination">
        @include('partials.articles_pagination_btn',[$articles_offset, $articles_count, $user])
    </div>
    @endif @else
    <p> No articles published </p>
    @endif
    <h2 class="w-100 pl-0 my-3">Following</h2>
    <div id="my_following_users" class="d-flex justify-content-between flex-wrap">
      @if ($following != null) @include('partials.following_list',$following)
    </div>
    @if(!($following_offset == 0 && $following_count
    <=0 )) <div id="following_pagination">
      @include('partials.following_pagination_btn',[$following_offset, $following_count])
  </div>
  @endif @else
  <p> Not following any user </p>
  @endif
</div>

</div>
</div>