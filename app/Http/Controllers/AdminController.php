<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\User;
use App\Ban;
use App\Section;
use App\Badge;
use App\News;
use App\Comment;
use Auth;

class AdminController extends Controller {

    private function getAllUsers(){
        $this->authorize('admin', Auth::user());
        return User::orderBy('id','asc')->get();
    }

    private function getUsersTableView($usersList,$pageNumber,$itemsPerPage) {
        $this->authorize('admin', Auth::user());
        $total = $usersList->count();
        return view('partials.admin_users_table', 
            ['users' => $usersList->forPage($pageNumber,$itemsPerPage),
            'total' => $total]);
        }
            
    public function promoteUser(Request $request, $username) {
        $this->authorize('admin', Auth::user());
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
        $this->authorize('admin', Auth::user());
        $user = User::where('username', $username)->firstOrFail();
        if($user->permission == 'moderator'){
            $user->permission = 'normal';
        }
        $user->save();
        return view('partials.admin_user_row',['user'=>$user]);
    }
    
    public function banUser(Request $request, $username){
        $this->authorize('admin', Auth::user());
        $adminBanning = Auth::user();
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
        return response('', 404);
    }

    public function unbanUser(Request $request, $username) {
        $this->authorize('admin', Auth::user());
        $bannedUser = User::where('username', $username)->firstOrFail();
        $wasBannedBefore = $bannedUser->ban()->get();
        if (!$wasBannedBefore) {
            return response('', 404);
        }
        $bannedUser->ban()->delete();
        return response()->json('User '.$username.' has been unbanned');
    }

    private function getUsersByName($username){
        return User::where('username','ilike', '%'.$username.'%')
            ->orderBy('id','asc')
            ->get();
    }
    
    public function getUsersTableRoute(Request $request) {
        $this->authorize('admin', Auth::user());
        $pageNumber = $request->pageNumber;
        $itemsPerPage=$request->itemsPerPage;
        if ($request->searchToken){
            $users = $this->getUsersByName($request->searchToken);
        }else{
            $users = $this->getAllUsers();
        }
        return $this->getUsersTableView($users,$pageNumber,$itemsPerPage);
    }

    public function getStatsTab(Request $request) {
        $this->authorize('admin', \Auth::user());
        $num_users = User::count();
        $num_bans = Ban::count();
        $num_news = News::count();
        $num_comments = Comment::count();
        return view('partials.admin_stats_tab',
            ['num_users' => $num_users, 'num_bans' => $num_bans,
            'num_news' => $num_news, 'num_comments' => $num_comments]);
    }

    public function getCategoriesTab(Request $request){
        $sections = Section::get();
        return view('partials.admin_categories_tab',
            ['categories'=>$sections]);
       }


    public function getBadgesTab(Request $request){
        $this->authorize('admin', \Auth::user());
        $badges = Badge::get();
        return view('partials.admin_badges_tab', ['badges' => $badges]);
    }


    public function getUsersTab(Request $request){
        $this->authorize('admin', \Auth::user());
        $currentPage = 1; $itemsPerPage = 10;
        $allUsers = $this->getAllUsers();
        $users = $allUsers->forPage($currentPage,$itemsPerPage);
        $total = $allUsers->count();
        $numberOfPages = intval(ceil($total/$itemsPerPage));
        return view('partials.admin_users_tab',
            ['users' => $users,
            'numberOfPages' => $numberOfPages,
            'currentPage'=>$currentPage,
            'itemsPerPage'=>$itemsPerPage,
            'total'=>$total]);
    }

    public function show()
    {
        $this->authorize('admin', Auth::user());
        $currentPage = 1;
        $itemsPerPage = 10;
        $allUsers = $this->getAllUsers();
        $users = $allUsers->forPage($currentPage,$itemsPerPage);
        $total = $allUsers->count();
        $numberOfPages = intval(ceil($total/$itemsPerPage));
        $categories = Section::get();
        return view('pages.admin', 
            ['users' => $users,
            'numberOfPages' => $numberOfPages,
            'currentPage'=>$currentPage,
            'itemsPerPage'=>$itemsPerPage,
            'total'=>$total,
            'page_title'=>'Control Panel']);
    }
}