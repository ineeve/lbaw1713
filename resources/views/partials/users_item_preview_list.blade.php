<div class="user_box border mx-4 my-2 p-2">
    <div style="position:relative;">
        <div class="my-2">
            <img class="img-responsive" src="{{ Storage::url('users/'.($user->picture == null ? 'default' : $user->picture)) }}" alt="pic" >
        </div>
        <div class="mx-3">
            <div class="row">
                <a class="nounderline" style="color:inherit;" href="{{ url('users/'.$user->username) }}">
                    <h3 class="font-weight-normal">{{ $user->username }}</h3></a>
            </div>
        </div>
    </div>
</div>