<div class="container-fluid">
    <div class="row mt-2">
        <!-- LEFT SECTIONS -->
        <div class="col-xl-2 col-lg-3 col-12">
        <div class="col-lg-12 col-sm-6 col-12 p-0">
            <h3 data-toggle="collapse" data-target="#sections_list" aria-expanded="true" aria-controls="sections_list">
                <i class="fas fa-bars"></i> Sections</h3>
            <div class="collapse" id="sections_list">
                <ul class="nav nav-pills flex-column left-pane">
                <li class="nav-item">
                    <a href="#users" role="button" data-toggle="tab" class="nav-link active">
                    <i class="fa fa-bullseye"></i> Users</a>
                </li>
                <li class="nav-item">
                    <a href="#categories" role="button" data-toggle="tab" class="nav-link">
                    <i class="fa fa-laptop"></i> Categories</a>
                </li>
                <li class="nav-item">
                    <a href="#badges" role="button" data-toggle="tab" class="nav-link">
                    <i class="fa fa-flask"></i> Badges</a>
                </li>
                <li class="nav-item">
                    <a href="#statistics" role="button" data-toggle="tab" class="nav-link">
                    <i class="fa fa-briefcase"></i> Statistics</a>
                </li>
                </ul>
            </div>
        </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="col-xl-10 col-lg-9 col-12">
        <div class="tab-content container-fluid">
            <div class="tab-pane active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="mb-2">
                <div class="row">
                <div class="col-12">
                    <h3>Users
                    </h3>
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
                                <input type="checkbox"> Ordinary</label>
                            </div>
                            </li>
                        </ul>
                        </div>
                        <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" id="roleFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="roleFilter">
                            <li>
                            <div class="dropdown-item">
                                <label>
                                <input type="checkbox"> Ordinary
                                <i class="text-success fas fa-circle"></i>
                                </label>
                            </div>
                            </li>
                            <li>
                            <div class="dropdown-item">
                                <label>
                                <input type="checkbox"> Semi-Active
                                <i class="text-warning fas fa-circle"></i>
                                </label>
                            </div>
                            </li>
                            <li>
                            <div class="dropdown-item">
                                <label>
                                <input type="checkbox"> Inactive
                                <i class="text-danger fas fa-circle"></i>
                                </label>
                            </div>
                            </li>
                        </ul>
                        </div>
                    </form>
                    </div>
                    <div class="row d-flex justify-content-between m-2">
                    <form class="d-flex align-items-center">
                        <input class="form-control mr-sm-2 rounded" type="search" placeholder="Search by username ..." aria-label="Search">
                    </form>
                    <h4>Displaying 10 out of 29 users</h4>
                    </div>
                    <!-- USERS TABLE -->
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
                            <th class="text-right" scope="col">Score
                            </th>
                            <th class="text-right" scope="col">Status
                            </th>
                            <th class="text-right" scope="col">Registered Since
                            </th>
                            <th class="text-right" scope="col">Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th class="text-left" scope="row">1
                            </th>
                            <td class="text-right">root
                            </td>
                            <td class="text-right">admin
                            </td>
                            <td class="text-right">admin@photonnews.com
                            </td>
                            <td class="text-right">0
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">2
                            </th>
                            <td class="text-right">Jacob
                            </td>
                            <td class="text-right">moderator
                            </td>
                            <td class="text-right">jacob@gmail.com
                            </td>
                            <td class="text-right">150
                            </td>
                            <td class="text-right">
                            <i class="text-warning fas fa-circle" data-toggle="tooltip" title="Active in last week">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-danger fas fa-angle-double-down" data-toggle="tooltip" title="Demote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">3
                            </th>
                            <td class="text-right">Mark
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">Mark@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-circle" data-toggle="tooltip" title="Inactive">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">4
                            </th>
                            <td class="text-right">MKAsd23k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">Marasdask@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-circle" data-toggle="tooltip" title="Inactive">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">5
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">6
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">7
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">8
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">9
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left" scope="row">10
                            </th>
                            <td class="text-right">aine3k
                            </td>
                            <td class="text-right">ordinary
                            </td>
                            <td class="text-right">ain3k@gmail.com
                            </td>
                            <td class="text-right">100
                            </td>
                            <td class="text-right">
                            <i class="text-success fas fa-circle" data-toggle="tooltip" title="Active in last 24h">
                            </i>
                            </td>
                            <td class="text-right">10/5/2017
                            </td>
                            <td class="text-right">
                            <i class="text-danger fas fa-ban" data-toggle="tooltip" title="Ban user">
                            </i>
                            <i class="text-success fas fa-angle-double-up" data-toggle="tooltip" title="Promote user">
                            </i>
                            </td>
                        </tr>
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
                            <td>
                            <i class="text-success fas fa-circle"></i> Active in last 24h</td>
                            <td>
                            <i class="text-warning fas fa-circle"></i> Active in last week</td>
                            <td>
                            <i class="text-danger fas fa-circle"></i> Inactive</td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                    <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item disabled">
                        <span class="page-link">Previous
                        </span>
                        </li>
                        <li class="page-item active">
                        <a class="page-link" href="#">1
                        </a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">2
                        </a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">3
                        </a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">Next
                        </a>
                        </li>
                    </ul>
                    </nav>
                </div>
                </div>
            </div>
            </div>
            <div class="tab-pane" id="badges" role="tabpanel" aria-labelledby="badges-tab">...
            </div>
            <div class="tab-pane" id="categories" role="tabpanel" aria-labelledby="categories-tab">...
            </div>
            <div class="tab-pane" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">...
            </div>
        </div>
        </div>
    </div>
</div>