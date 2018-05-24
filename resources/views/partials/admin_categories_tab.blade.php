<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3>Categories</h3>
            <!-- CATEGORIES TABLE -->
            <div class="table-responsive">
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
                        @foreach($users as $user)
                        <tr>
                            <th class="text-left" scope="row">{{$user->id}}
                            </th>
                            <td class="text-right">{{$user->username}}
                            </td>
                            <td class="text-right">{{$user->permission}}
                            </td>
                            <td class="text-right">{{$user->email}}
                            </td>
                            <td class="text-right">{{$user->points}}
                            </td>
                            <td class="text-right">
                                @if($user->permission=='moderator')
                                <i class="text-danger fas fa-angle-double-down mr-1" data-toggle="tooltip" title="Demote user"></i>
                                @endif @if($user->permission=='moderator' || $user->permission=='normal')
                                <i class="text-success fas fa-angle-double-up mr-1" data-toggle="tooltip" title="Promote user"></i>
                                <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user"></i>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- TABLE LEGEND -->
            <div class="table-responsive table-legend">
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <i class="text-danger fas fa-ban"></i> Ban</td>
                            <td>
                                <i class="text-success fas fa-angle-double-up"></i> Promote</td>
                            <td>
                                <i class="text-danger fas fa-angle-double-down"></i> Demote</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            
        </div>
    </div>
</div>