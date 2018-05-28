@include('partials/modals/admin_confirm_ban_modal')
<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3><i class="fa fa-bullseye"></i> Users</h3>
            <div class="row m-2 align-items-center">
                <h5>Filter By
                </h5>
                <form class="d-flex ml-2">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="roleFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Role
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="roleFilter">
                            <li>
                                <div class="dropdown-item">
                                    <label>
                                        <input type="checkbox"> Admin</label>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-item">
                                    <label>
                                        <input type="checkbox"> Moderator</label>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-item">
                                    <label>
                                        <input type="checkbox"> Normal</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="row d-flex justify-content-between m-2">
                <form class="d-flex align-items-center">
                    <input id="searchUsername" class="form-control mr-sm-2 rounded" type="search" placeholder="Search by username ..." aria-label="Search">
                </form>
            </div>
            <div id="alert-messages">
            </div>
            <!-- USERS TABLE -->
            @include('partials.admin_users_table',['users' => $users, 'total'=> $total])

        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-10">
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
            <!-- PAGINATION -->
            @include('partials.pagination',['currentPage'=>$currentPage,'numberOfPages'=>$numberOfPages])
        </div>
    </div>
</div>