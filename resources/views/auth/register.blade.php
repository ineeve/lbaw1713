@extends('layouts.app')

@section('content')
<form class="profile_item container p-2 mx-auto mt-5" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-6">
        <fieldset class="form-group">
          <legend>Account details</legend>
          <label for="username">Username:</label>
          <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
          @if ($errors->has('username'))
            <span class="error">
                {{ $errors->first('username') }}
            </span>
          @endif
          <label for="email">E-Mail Address:</label>
          <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
          @if ($errors->has('email'))
            <span class="error">
                {{ $errors->first('email') }}
            </span>
          @endif
          <label for="password">Password:</label>
          <input id="password" type="password" name="password" class="form-control" required>
          @if ($errors->has('password'))
            <span class="error">
                {{ $errors->first('password') }}
            </span>
          @endif
          
          <label for="password-confirm">Confirm Password:</label>
          <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">
          <legend>Personal details</legend>
          <label for="picture">Profile picture:</label>
          <input id="picture" type="file" name="picture" class="form-control">
          @if ($errors->has('picture'))
            <span class="error">
                {{ $errors->first('picture') }}
            </span>
          @endif

          <label for="gender">Gender:</label>
          <select class="custom-select" id="gender" name="gender" required="required">
            <option value="" disabled selected>Select your gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
          </select>
          @if ($errors->has('gender'))
            <span class="error">
                {{ $errors->first('gender') }}
            </span>
          @endif
          
          <label for="country">Country:</label>
          <select id="country" name="country_id" class="form-control">
              <option value="" disabled selected>Select your country</option>
              @foreach ($countries as $country)
                <option value="{{$country->id}}"> {{$country->name}} </option>
              @endforeach
          </select>
          @if ($errors->has('country_id'))
            <span class="error">
                {{ $errors->first('country_id') }}
            </span>
          @endif
        </fieldset>
          
          
      </div>
    

    <button class="btn btn-primary ml-3" type="submit">
      Register
    </button>
</form>
@endsection
