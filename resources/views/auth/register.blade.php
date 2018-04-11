@extends('layouts.app')

@section('content')
<form class="profile_item container p-2 mx-auto mt-5" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="username">Username</label>
          <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
          @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
          @endif
        </div>
        <div class="form-group">
          <label for="email">E-Mail Address</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" class="form-control" required>
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
        </div>
          
        <div class="form-group">
          <label for="password-confirm">Confirm Password</label>
          <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
        </div>
          
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="picture">Profile picture:</label>
          <input id="picture" type="file" name="picture" class="form-control">
          @if ($errors->has('picture'))
            <span class="error">
                {{ $errors->first('picture') }}
            </span>
          @endif
        </div>
          
        <div class="form-group">
          <label for="gender">Gender:</label>
          <select class="custom-select" id="gender" name="gender" class="form-control">
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
          </select>
          @if ($errors->has('gender'))
            <span class="error">
                {{ $errors->first('gender') }}
            </span>
          @endif
        </div>
          
        <div class="form-group">
          <label for="country">Country:</label>
          <select id="country" name="country_id" class="form-control">
              <option value="" disabled selected>Select your country</option>
              @foreach ($countries as $country)
                <option value={{$country->id}}> {{$country->name}} </option>
              @endforeach
          </select>
        </div>
          
          
      </div>
    

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form>
@endsection
