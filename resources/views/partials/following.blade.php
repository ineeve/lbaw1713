<div>
    <img class="img-responsive" src="{{ Storage::url('users/'.($user->picture == null ? 'default' : $user->picture)) }}" alt="Icon">
    <a class="nounderline" style="color:inherit;" href="{{ url('users/'.$user->username) }}">
        <h4 class="font-weight-bold mt-2">{{ $user->username }}</h4>
    </a>
</div>