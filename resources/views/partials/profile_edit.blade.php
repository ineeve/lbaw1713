<!-- <form class="profile_item border container p-2 mx-auto mt-3" 
action="/users/{{Auth::user()->username}}/edit" 
method="post"
> -->
<div class="profile_item border container p-2 mx-auto mt-3">
{{ Form::open(['route' => ['update_user', Auth::user()->username], 'method' => 'patch']) }}
{{ Form::hidden('IDInput', Auth::user()->id) }}
{{ csrf_field() }}
    <div class="row">
      <div class="col-md-6">
      <!-- TODO: Alter Image path -->
        <img src="{{asset('storage/users/'.Auth::user()->picture)}}" alt="Profile Photo" height="200px" width="200px">
        <div class="form-group">
          <label for="inputPhoto">Input Photo:</label>
          <input type="file" class="form-control-file" id="inputPhoto" aria-describedby="fileHelp">
          <small id="fileHelp" class="form-text text-muted">Please choose an image!</small>
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address:</label>
          <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" value="{{Auth::user()->email}}">
          <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
        </div>
        <div class="form-group">
          <label for="inputCountry">Country:</label>
          <select id="country" name="country_id" class="form-control">
          <!-- TODO: preselect country -->
              <option value="" disabled>Select your country</option>
              @foreach ($countries as $country)
                <option value="{{$country->id}}"
                @if($country->id === Auth::user()->country_id)
                  selected
                  @endif
                > {{$country->name}}
                 </option>
              @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label class="col-form-label" for="inputDefault">Username:</label>
          <input type="text" class="form-control" value="{{Auth::user()->username}}" id="usernameInput">
        </div>
        <div class="form-group">
          <label class="col-form-label" for="gender">Gender:</label>
          <select class="custom-select" id="gender" name="gender" class="form-control">
            <option value="" disabled>Select your gender</option>
            <option value="female" @if('female' == Auth::user()->gender)
                  selected
                  @endif >Female</option>
            <option value="male" @if('male' == Auth::user()->gender)
                  selected
                  @endif >Male</option>
            <option value="other" @if('other'== Auth::user()->gender)
                  selected
                  @endif >Other</option>
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
{{ Form::close() }}
<div>
  <!-- </form> -->