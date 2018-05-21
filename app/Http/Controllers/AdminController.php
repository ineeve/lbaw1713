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
        return view('partials.admin_users_tab', 
            ['users' => $users,
            'total' => $total,
            'currentPage'=>$pageNumber,
            'itemsPerPage'=>$itemsPerPage]);
    }

    public function promoteUser(Request $request, $username){
        //todo::checkPermissions
        $user = User::where('username', $username)->firstOrFail();
        if($user->permission == 'normal'){
            $user->permission = 'moderator';
        }else{
            $user->permission = 'admin';
        }
        $user->save();
        return view('partials.admin_user_row',['user'=>$user]);
    }
    public function demoteUser(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        if($user->permission == 'moderator'){
            $user->permission = 'normal';
        }
        $user->save();
        return view('partials.admin_user_row',['user'=>$user]);
    }
    public function banUser(Request $request, $username){
        $user = User::where('username', $username)->firstOrFail();
        
    }
    
    public function getUsersTabRoute(Request $request){
        //todo::checkPermissions
        $pageNumber = $request->pageNumber;
        $itemsPerPage=$request->itemsPerPage;
        return $this->getUsersTab($pageNumber,$itemsPerPage);
    }

    public function show()
    {
        //todo::check permissions
        $currentPage = 1;
        $itemsPerPage = 10;
        $users = $this->getUserList('id',$currentPage,$itemsPerPage);
        $total = $this->getTotalNumberOfUsers();
        return view('pages.admin', 
            ['users' => $users,
            'total' => $total,
            'currentPage'=>$currentPage,
            'itemsPerPage'=>$itemsPerPage]);
    }
}
