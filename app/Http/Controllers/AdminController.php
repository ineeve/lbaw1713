<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\User;
use App\Ban;

class AdminController extends Controller {

    private function getUsersNotBanned() {
        $this->authorize('admin', \Auth::user());
        return User::orderBy('id','asc')
            ->get()
            ->filter(function($val){
                return $val->ban->isEmpty();
        });
        
    }

    private function getUsersForPage($pageNumber,$itemsPerPage){
        $users = $this->getUsersNotBanned();
        return $users->forPage($pageNumber,$itemsPerPage);
    }

    private function getUsersTable($pageNumber,$itemsPerPage) {
        $this->authorize('admin', \Auth::user());
        $users = $this->getUsersNotBanned();
        $total = $users->count();
        return view('partials.admin_users_table', 
            ['users' => $users->forPage($pageNumber,$itemsPerPage),
            'total' => $total]);
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
        $wasBannedBefore = $bannedUser->ban()->get();
        if($wasBannedBefore->isEmpty()){
            $ban = new Ban;
            $ban->banned_user_id = $bannedUser->id;
            $ban->admin_user_id = $adminBanning->id;
            $ban->reason = $request->reason;
            $ban->save();
            return response()->json([
                'message' => 'User '.$username.' has been banned'
            ]);
        }
        return response('',404);
    }
    public function searchUser(Request $request, $username){
        $this->authorize('admin',\Auth::user());
        $users = User::where('username','ilike', '%'.$username.'%')->get();
        return view('partials.admin_users_table', 
            ['users' => $users,
            'total' => $users->count()]);
    }
    
    public function getUsersTableRoute(Request $request) {
        $this->authorize('admin', \Auth::user());
        $pageNumber = $request->pageNumber;
        $itemsPerPage=$request->itemsPerPage;
        return $this->getUsersTable($pageNumber,$itemsPerPage);
    }

    public function show()
    {
        $this->authorize('admin', \Auth::user());
        $currentPage = 1;
        $itemsPerPage = 10;
        $users = $this->getUsersForPage($currentPage,$itemsPerPage);
        $total = $this->getUsersNotBanned()->count();
        $numberOfPages = intval(ceil($total/$itemsPerPage));
        return view('pages.admin', 
            ['users' => $users,
            'numberOfPages' => $numberOfPages,
            'currentPage'=>$currentPage,
            'itemsPerPage'=>$itemsPerPage,
            'total'=>$total]);
    }
}
