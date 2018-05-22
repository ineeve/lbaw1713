<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\User;

class AdminController extends Controller {

    private function getUserList($orderBy,$pageNumber,$itemsPerPage) {
        $this->authorize('admin', \Auth::user());
        return User::orderBy('id', 'asc')
               ->forPage($pageNumber,$itemsPerPage)
               ->get();
    }

    private function getTotalNumberOfUsers(){
        $this->authorize('admin', \Auth::user());
        return User::count();
    }


    private function getUsersTab($pageNumber,$itemsPerPage) {
        $this->authorize('admin', \Auth::user());
        $users = $this->getUserList('id',$pageNumber,$itemsPerPage);
        $total = $this->getTotalNumberOfUsers();
        return view('partials.admin_users_tab', 
            ['users' => $users,
            'total' => $total,
            'currentPage'=>$pageNumber,
            'itemsPerPage'=>$itemsPerPage]);
    }

    public function promoteUser(Request $request, $username) {
        $this->authorize('admin', \Auth::user());
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
        $this->authorize('admin', \Auth::user());
        $user = User::where('username', $username)->firstOrFail();
        if($user->permission == 'moderator'){
            $user->permission = 'normal';
        }
        $user->save();
        return view('partials.admin_user_row',['user'=>$user]);
    }

    public function banUser(Request $request, $username){
        $this->authorize('admin', \Auth::user());
        $adminBanning = \Auth::user();
        $bannedUser = User::where('username', $username)->firstOrFail();
        if (count(DB::table('Bans')->where('banned_user_id', $bannedUser->id)) > 0) {
            DB::insert('INSERT INTO Bans (banned_user_id, admin_user_id, reason) VALUES (?, ?, ?)', [$bannedUser->id, $adminBanning->id, $request->reason]);
        }
    }
    
    public function getUsersTabRoute(Request $request) {
        $this->authorize('admin', \Auth::user());
        $pageNumber = $request->pageNumber;
        $itemsPerPage=$request->itemsPerPage;
        return $this->getUsersTab($pageNumber,$itemsPerPage);
    }

    public function show()
    {
        $this->authorize('admin', \Auth::user());
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
