<div id="usersTable" class="table-responsive">
    <input id="total" type="hidden" value={{$total}}>
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="text-left" scope="col">#
                </th>
                <th class="text-right" scope="col">Username
                </th>
                <th class="text-right" scope="col">Role
                </th>
                <th class="text-right" scope="col">Email
                </th>
                <th class="text-right" scope="col">Points
                </th>
                </th>
                <th class="text-right" scope="col">Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user) @include('partials/admin_user_row',['user'=>$user]) @endforeach
        </tbody>
    </table>
</div>