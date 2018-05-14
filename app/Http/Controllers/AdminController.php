<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\User;

class AdminController extends Controller
{


    private function getUserList($orderBy,$pageNumber,$itemsPerPage){
        return User::orderBy('id', 'asc')
               ->forPage($pageNumber,$itemsPerPage)
               ->get();
    }

    private function getTotalNumberOfUsers(){
        return User::count();
    }


    private function getUsersTab($pageNumber,$itemsPerPage){
        $users = $this->getUserList('id',$pageNumber,$itemsPerPage);
        $total = $this->getTotalNumberOfUsers();
        return view('pages.admin', 
            ['users' => $users,
            'total' => $total,
            'currentPage'=>$pageNumber,
            'itemsPerPage'=>$itemsPerPage]);
    }
    
    public function getUsersTabRoute(Request $request){
        $pageNumber = $request->pageNumber;
        $itemsPerPage=$request->itemsPerPage;
        return $this->getUsersTab($pageNumber,$itemsPerPage);
    }

    public function show()
    {
        //todo::check permissions
        $currentPage = 1;
        $itemsPerPage = 10;
        return $this->getUsersTab($currentPage,$itemsPerPage);
    }
}
