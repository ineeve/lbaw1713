<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Styles -->
  <!-- <link href="{{ asset('css/milligram.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
  </script>
  <script type="text/javascript" src={{ asset( 'js/app.js') }} defer>
  </script> -->

  <!-- OUR -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Font Awesome CSS -->
  <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/bootswatch.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- Optional JavaScript -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

    <!-- event handler script -->
    <script type="text/javascript" src={{ asset( 'js/app.js') }} defer>
  </script> 

  <!-- END OUR -->

  @yield('text_editor')

</head>

<body>
  <main>
    <header class="container-fluid px-0">
      <!-- NAVBAR -->
      <nav class="row navbar navbar-expand-lg navbar-dark bg-primary mx-0">
        <div class="col-12 col-md-3">
          <a class="navbar-brand" href="{{ route('homepage') }}">Photon News</a>
        </div>
        <div class="col-12 col-md-5">
          <div class="container ml-0 d-flex flex-column px-0">
            <form class="form-inline" action="advanced_search.html" method="post">
              <input class="form-control mr-sm-2 rounded" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-light my-2 my-sm-0 rounded" type="submit">
                <a href="advanced_search.html" style="color:inherit; text-decoration:none">Search</a>
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
                <button class="btn btn-outline-light my-2 my-sm-0 rounded">
                  <a href="{{ route('create_news') }}" style="color:inherit; text-decoration:none">
                    Publish
                  </a>
                </button>
              </li>

              <!-- Notifications -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                  <i class="fas fa-bell">
                  </i> Notifications</a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" x-placement="bottom-start">
                  @each('partials.notification', Auth::user()->notifications()->orderBy('date')->get(), 'notification')
                </div>
              </li>
              <!-- Account -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                  <i class="fas fa-user-circle"></i>{{ Auth::user()->username }}</a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" x-placement="bottom-start">
                  <a class="dropdown-item" href="profile.html">
                    <i class="fas fa-user">
                    </i> Profile
                  </a>
                  <a class="dropdown-item" href="forum.html">
                    <i class="fas fa-university">
                    </i> Forum
                  </a>
                  <a class="dropdown-item" href="settings.html">
                    <i class="fas fa-cog">
                    </i> Settings
                  </a>
                  <a class="dropdown-item" href="/logout">
                    <i class="fas fa-sign-out-alt">
                    </i> Log out
                  </a>
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
                    <!-- TODO: ver action -->
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="dropdownFormEmail">Email address</label>
                      <input name="email" type="email" class="form-control" id="dropdownFormEmail" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                      <label for="dropdownFormPassword">Password</label>
                      <input name="password" type="password" class="form-control" id="dropdownFormPassword" placeholder="Password">
                    </div>
                    <div class="form-check">
                      <input name="rememberMe" type="checkbox" class="form-check-input" id="dropdownCheck">
                      <label class="form-check-label" for="dropdownCheck">
                        Remember me
                      </label>
                    </div>
                    <button onclick="signIn()" type="submit" class="btn btn-primary">Sign in</button>
                  </form>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="register">New around here? Sign up</a>
                  <a class="dropdown-item" href="#">Forgot password?</a>
                </div>
              </li>
            </ul>
            @endif
            </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

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
            <form class="" action="advanced_search.html" method="post">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <div class="form-group my-1">
                <select class="custom-select">
                  <option selected>Search for...</option>
                  <option value="1">Only title</option>
                  <option value="2">Only body</option>
                  <option value="3">Title and body</option>
                  <option value="4">Username</option>
                </select>
              </div>
              <div class="form-group my-1">
                <select class="custom-select">
                  <option selected>Section...</option>
                  <option value="1">World</option>
                  <option value="2">Technology</option>
                  <option value="3">Science</option>
                  <option value="4">Business</option>
                  <option value="5">Sports</option>
                </select>
              </div>
              <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="News' Author...">
              <div class="d-flex">
                <div class="form-group">
                  <!-- <p><time></time></p> -->
                  <label class="col-form-label">Begin:</label>
                  <input type="date" class="form-control" value="1990-01-01">
                </div>
                <div class="form-group">
                  <!-- <p><time></time></p> -->
                  <label class="col-form-label">End:</label>
                  <input type="date" class="form-control" value="2018-03-15">
                </div>
              </div>
              <button type="submit" class="btn btn-primary float-right">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <section id="content">
      @yield('content')
    </section>
    <footer class="page-footer sticky-bottom mt-4">
      <p class=" mx-auto text-center mb-0">
        <a href="#">About us</a>
        &middot;
        <a href="#">FAQ</a>
      </p>
      <p class="text-center footer-copyright mb-1">
        <i class="far fa-copyright"></i> 2018 Photon News</p>
    </footer>
  </main>
</body>

</html>