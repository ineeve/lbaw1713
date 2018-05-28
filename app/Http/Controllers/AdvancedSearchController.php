<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Storage;
use Image;
use \stdClass;

use App\News as News;
use App\Section as Section;
use App\Source as Source;

class AdvancedSearchController extends Controller
{
    private function searchUsers($searchText, $offset) {
        $name = strtolower($searchText);
        return DB::select("SELECT users.id, username, picture
        FROM users WHERE LOWER(users.username) LIKE '%{$name}%'
        ORDER BY username DESC LIMIT 20 OFFSET ?;",[$offset]);
      }

      public function getAdvancedSearchPage(Request $request){
        $typeOfSearch = $request->elementToSearch;
        $searchText = $request->searchText;
  
        if($typeOfSearch == 'titleAndBody') {
  
        }
        if($typeOfSearch == 'onlyTitle') {
  
        }
        if($typeOfSearch == 'onlyBody') {
  
        }
        if($typeOfSearch == 'username') {
          $filteredUser = $this->searchUsers($searchText, 0);
          return view('pages.searched_users',['users'=> $filteredUser, 'searchText' => $searchText]);
        }
      }

      public function scrollAdvancedSearchUsers(Request $request, $searchText) {

        $filteredUser = $this->searchUsers($searchText, $request->input('offset'));
        $views = array();
        foreach($filteredUser as $user) {
            $views[] = View::make('partials.users_item_preview_list')->with('user', $user)->render();
        }
    
        $status_code = 200; // TODO: change if not found!
        $data = [
            'users' => $views,
            'next' => count($filteredUser)
        ];

        return Response::json($data, $status_code);
    }
}