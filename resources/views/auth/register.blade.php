@extends('layouts.app')

@section('content')

<form class="profile_item container p-2 mx-auto mt-5" enctype="multipart/form-data" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-12">
        <span title="Only username, email and password are required">General Help <i class="far fa-question-circle fa-fw"></i></span>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">
          <legend>Account details</legend>
          <label class="mt-2" for="username"><i title="Your username will be public to other users. It should not be over 30 characters." class="far fa-question-circle fa-fw"></i> Username *</label>
          @if ($errors->has('username'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('username') }}
            </span>
          @endif
          <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>


          <label class="mt-2" for="email"><i title="Your email will be public to other users. It can be used to login and to recover your password later." class="far fa-question-circle fa-fw"></i> E-Mail Address *</label>
          @if ($errors->has('email'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('email') }}
            </span>
          @endif
          <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>

          
          <label class="mt-2" for="password"><i class="far fa-question-circle fa-fw" title="Your password should be secure. Our only restriction is to have more than 6 characters"></i> Password *</label>
          @if ($errors->has('password'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('password') }}
            </span>
          @endif
          <input id="password" type="password" name="password" class="form-control" required>

          
          <label class="mt-2" for="password-confirm"><i class="far fa-question-circle fa-fw" title="Password confirmation is required to avoid mistyping"></i> Confirm Password *</label>
          <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required>
        </fieldset>
      </div>
      <div class="col-md-6">
        <fieldset class="form-group">
          <legend>Personal details</legend>
          <label class="mt-2" for="picture"><i class="far fa-question-circle fa-fw" title="You are not required to upload a picture, we provide a default one. The picture will be publicly displayed in your profile."></i> Profile picture</label>
          @if ($errors->has('picture'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('picture') }}
            </span>
          @endif
          <input id="picture" type="file" name="picture" class="form-control">

          <label class="mt-2" for="gender"><i class="far fa-question-circle fa-fw" title="You are not required to set your gender, although we provide an 'other' option. If you select one, it will be publicly displayed in your profile"></i> Gender</label>
          @if ($errors->has('gender'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('gender') }}
            </span>
          @endif
          <select class="custom-select" id="gender" name="gender">
            <option value="" disabled selected>Select your gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
          </select>

          
          <label class="mt-2" for="country"><i class="far fa-question-circle fa-fw" title="You are not required to set your country. If you select one, it will be publicly displayed in your profile."></i> Country</label>
          @if ($errors->has('country_id'))
            <span class="error">
              <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('country_id') }}
            </span>
          @endif
          <select id="country" name="country_id" class="form-control">
              <option value="" disabled selected>Select your country</option>
              @foreach ($countries as $country)
                <option value="{{$country->id}}"> {{$country->name}} </option>
              @endforeach
          </select>

        </fieldset>
          
      </div>
        <button class="btn btn-primary ml-3" type="submit">
        Register
        </button>
      </div>
      <div class="mt-5">* Field required</div>
</form>

@endsection
