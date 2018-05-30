@include('partials/modals/admin_confirm_ban_modal')
<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
            <h3><i class="fas fa-user-tie fa-fw"></i> Users</h3>
            
            <div class="row d-flex justify-content-between mt-3 ml-1 mb-2">
                <form class="d-flex align-items-center">
                    <label for="searchUsername">Search by username</label>
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
                                <i class="text-danger fas fa-ban fa-fw"></i> Ban</td>
                            <td>
                                <i class="text-success fas fa-angle-double-up fa-fw"></i> Promote</td>
                            <td>
                                <i class="text-danger fas fa-angle-double-down fa-fw"></i> Demote</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- PAGINATION -->
            @include('partials.pagination',['currentPage'=>$currentPage,'numberOfPages'=>$numberOfPages])
        </div>
    </div>
</div>