<header class="container-fluid px-0">

      <!-- NAVBAR -->
      <nav class="row navbar navbar-expand-lg navbar-dark bg-primary mx-0">
        <div class="col-12 col-md-3">
          <a class="navbar-brand" href="{{ route('homepage') }}">Photon News</a>
        </div>
        <div class="col-12 col-md-5">
          <div class="container ml-0 d-flex flex-column px-0">
            <form class="form-inline" action="{{route("search")}}" method="get">
              <input class="form-control mr-sm-2 rounded" name="searchText" type="search" placeholder="Search" aria-label="Search" required>
              <button class="btn btn-outline-light my-2 my-sm-0 rounded" type="submit">
                Search
              </button>
            </form>
            <a class="small" data-toggle="modal" style="color:white;" href="#searchModal">advanced search</a>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="navbar-collapse collapse show" id="navbar">
            @if (Auth::check())
            <ul class="navbar-nav ml-auto">
              <!-- Publish -->
              <li class="nav-item">
                <a class="btn btn-outline-light my-2 my-sm-0 rounded" href="{{ route('create_news') }}" style="text-decoration:none">
                  <span style="color: inherit">Publish</span>
                </a>
              </li>

              <!-- Notifications -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                
                @if((bool)Auth::user()->notifications()->where('was_read', FALSE)->first())
                  <i class="fas fa-bell" style="color: yellow;">
                  </i> Notifications</a>
                @else
                <i class="fas fa-bell">
                  </i> Notifications</a>
                @endif
                <div class="dropdown-menu dropdown-menu-right position-absolute" >
                  @each('partials.notification', Auth::user()->notifications()->where('was_read', FALSE)->orderBy('date', 'desc')->get(), 'notification')
                </div>
              </li>
              <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                  <i class="fas fa-user-circle mr-1"></i>{{ Auth::user()->username }}</a>
                <div class="dropdown-menu dropdown-menu-right position-absolute">
                  <a class="dropdown-item" href="/users/{{Auth::user()->username}}">
                    <i class="fas fa-user">
                    </i> Profile
                  </a>
                  @can('mod', Auth::user())
                    <a class="dropdown-item" href="/reports">
                      <i class="fas fa-university">
                      </i> Forum
                    </a>
                  @endcan
                  <a class="dropdown-item" href="{{ route('show_settings') }}">
                    <i class="fas fa-cog">
                    </i> Settings
                  </a>
                  @can('admin', Auth::user())
                    <a class="dropdown-item" href="{{ route('show_admin_page') }}">
                      <i class="fab fa-autoprefixer"></i>
                      Admin
                    </a>
                  @endcan
                  <form class="dropdown-item logout" method="POST" action="/logout">
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <span style="cursor:pointer" class="logout">
                      <i class="fas fa-sign-out-alt">
                      </i> Log out
                    </span>
                    <script>
                      $('span.logout').click(function() {
                        $('form.logout').submit();
                      });
                    </script>
                  </form>
                </div>
              </li>
            </ul>
            @else
            <ul class="navbar-nav ml-auto">
              <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                  aria-expanded="false">
                  <!-- Account -->
                  <i class="fas fa-user-circle"></i> Sign In
                </a>
                <!-- DROPDOWN FOR SIGN IN -->
                <div class="dropdown-menu dropdown-menu-right position-absolute mt-0">
                  <form class="px-4 py-3" method="POST" action="/login">
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="dropdownFormEmail">Email address</label>
                      <input name="email" type="email" class="form-control" id="dropdownFormEmail" placeholder="email@example.com" required>
                    </div>
                    <div class="form-group">
                      <label for="dropdownFormPassword">Password</label>
                      <input name="password" type="password" class="form-control" id="dropdownFormPassword" placeholder="Password" required>
                    </div>
                    <div class="form-check">
                      <input name="rememberMe" type="checkbox" class="form-check-input" id="dropdownCheck">
                      <label class="form-check-label" for="dropdownCheck">
                        Remember me
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/register">New around here? Sign up</a>
                  <a class="dropdown-item" href="{{ route('password.request') }}">Forgot password?</a>
                  
                </div>
              </li>
            </ul>
            @endif
          </div>
        </div>
      </nav>
      @if ($errors->has('email') || $errors->has('password'))
        <div class="container mt-2">
        @if ($errors->has('email'))
          <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong> {{ $errors->first('email') }} </strong>
          </div>
        @else
            <div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <strong> {{ $errors->first('password') }} </strong>
            </div>
        @endif
        </div>
      @endif
      
</header>
