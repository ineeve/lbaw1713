<?php $numberOfPages = intval(ceil($total/$itemsPerPage));?>

<div class="mb-2">
    <div class="row">
        <div class="col-12 col-md-10">
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
                                        <input type="checkbox"> Normal</label>
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
                <h4>Displaying 10 out of {{$total}} users</h4>
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

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item" value='0'>
                        <a class="page-link" href="#">First</a>
                    </li>
                    @if($currentPage<5)
                        @for($i=1;$i<$currentPage;$i++)
                        <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @else
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                        @for($i=$currentPage-3;$i<$currentPage;$i++)
                        <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                        </li>
                        @endfor
                    @endif
                        <li class="page-item active" value={{$i}}>
                            <a class="page-link" href="#">{{$currentPage}}</a>
                        </li>
                        @for($i=$currentPage+1;$i<$currentPage+4&&$i<=$numberOfPages;$i++) 
                            <li class="page-item" value={{$i}}>
                            <a class="page-link" href="#">{{$i}}</a>
                            </li>
                        @endfor 
                            @if($currentPage+4 <= $numberOfPages)
                            <li class="page-item disabled">
                                <span class="page-link">...</span>
                            </li>
                            @endif
                            <li class="page-item" value={{$numberOfPages}}>
                                <a class="page-link" href="#">Last</a>
                            </li>
                </ul>
            </nav>
        </div>
    </div>
</div>