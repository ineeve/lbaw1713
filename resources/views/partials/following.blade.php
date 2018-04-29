<div>
    <img class="img-responsive" src="{{ Storage::url('users/'.($user->picture == null ? 'default' : $user->picture)) }}" alt="Icon">
    <h4 class="font-weight-bold mt-2">{{ $user->username }}</h4>
</div>