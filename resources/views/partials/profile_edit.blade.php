<form class="profile_item border container p-2 mx-auto mt-3" 
action="/users/{{Auth::user()->username}}/edit" 
method="post">
    <div class="row">
      <div class="col-md-6">
      <!-- TODO: Alter Image path -->
        <img src="https://c1.staticflickr.com/3/2936/14387367072_85312c31b3_b.jpg" alt="pic" height="200px" width="200px">
        <div class="form-group">
          <label for="inputPhoto">Input Photo:</label>
          <input type="file" class="form-control-file" id="inputPhoto" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Please choose an image!</small>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address:</label>
          <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="{{Auth::user()->email}}">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
          <label for="inputCountry">Country:</label>
          <select id="country" name="country_id" class="form-control">
          <!-- TODO: preselect country -->
              <option value="" disabled>Select your country</option>
              @foreach ($countries as $country)
                <option value="{{$country->id}}"> {{$country->name}}
                 </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label" for="inputDefault">Username:</label>
          <input type="text" class="form-control" placeholder="{{Auth::user()->username}}" id="usernameInput">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="gender">Gender:</label>
          <select class="custom-select" id="gender">
            <option value="female">Female</option>
            <option value="male">Male</option>
          </select>
        </div>
        <div class="mt-5 mb-1">
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="inputPassword1" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword1" placeholder="Password">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>

  </form>