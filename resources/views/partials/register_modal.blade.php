  <!-- REPORT MODAL -->
  <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerModalLabel">Login needed!</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form class="px-4 py-3" method="POST" action="/login">
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
              <div class="px-4 fb-login-button" scope="public_profile,email" onlogin="checkLoginState()" data-max-rows="1" data-size="medium" data-button-type="login_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false"></div>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="/register">New around here? Sign up</a>
              <a class="dropdown-item" href="#">Forgot password?</a>
        </div>
      </div>
    </div>
  </div>