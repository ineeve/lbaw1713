<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Storage;
use Image;
use \stdClass;

use App\News as News;
use App\Section as Section;
use App\Source as Source;

use App\User as User;

class UserController extends Controller
{
    public function edit() {
        $countries = User::getCountries();
        return view('pages.profile_edit', ['countries' => $countries]);
    }

    public function show($username)
    {

      $user = User::queryUser($username);

      $total_badges = (User::countBadges())[0]->count;

      $nth_badges = User::queryNthBadges($username, 6);

      $achieved_badges = User::queryBadges($username, 0);

      $news = User::queryArticles($username, 0);

      $articles_count = ceil(count(User::queryAllArticles($username))/ 5);

      $following = User::queryFollowing($username, 0);

      $following_count = ceil(count(User::queryAllFollowing($username))/ 5);
      
      $articles_offset = 0;
      $following_offset = 0;

      return view('pages.profile', ['user' => $user,
       'total_badges' => $total_badges,
       'nth_badges' => $nth_badges,
       'achieved_badges' => $achieved_badges,
       'news' => $news,
       'articles_count' => $articles_count,
       'following_count' => $following_count,
       'following' => $following,
       'articles_offset' => $articles_offset,
       'following_offset' => $following_offset]);
    }

    public function getArticles($username) {
      $articles_offset = Input::get('offset');
      $news = $this->queryArticles($username, $articles_offset);
      
      $articles_count = count($this->queryAllArticles($username)) - 5 - $articles_offset;

      $user = $this->queryUser($username);

      $status_code = 200; // TODO: change if not found!
      $data = [
          'view' => View::make('partials.news_item_preview_list')
              ->with('news', $news)
              ->render(),
          'view_pagination' => View::make('partials.articles_pagination_btn')
              ->with('user', $user)
              ->with('articles_count', $articles_count)
              ->with('articles_offset', $articles_offset)
              ->render(),
          'articles_count' => $articles_count,
          'articles_offset' => $articles_offset
      ];

      return Response::json($data, $status_code);
    }

    public function getFollowing($username) {
      $following_offset = Input::get('offset');
      $following = $this->queryFollowing($username, $following_offset);
      
      $following_count = count($this->queryAllFollowing($username)) - 5 - $following_offset;

      $user = $this->queryUser($username);

      $status_code = 200; // TODO: change if not found!
      $data = [
          'view' => View::make('partials.following_list')
              ->with('following', $following)
              ->render(),
          'view_pagination' => View::make('partials.following_pagination_btn')
              ->with('user', $user)
              ->with('following_count', $following_count)
              ->with('following_offset', $following_offset)
              ->render(),
          'following_count' => $following_count,
          'following_offset' => $following_offset
      ];

      return Response::json($data, $status_code);
    }

    public function startFollowing($username) {
      $user = User::queryUser($username);

      User::insertFollowing($user);

      $status_code = 200;
      $data = [];
      return Response::json($data, $status_code);
    }

    public function stopFollowing($username) {
      $user = $this->queryUser($username);

      User::deleteFollowing($user);


      $status_code = 200;
      $data = [];
      return Response::json($data, $status_code);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'country' => 'string|nullable',
            'gender' => 'string|nullable',
            'picture' => 'nullable'
        ]);
    }

    public function update(Request $request, $username) {
        $user = User::find($request->IDInput);
        $this->authorize('update', $user);
        $flag = FALSE;

        if(($user->username != $request->username) && ($request->username!=null)) {
          $this->validate($request,[
            'username'=>'required|string|max:255|unique:users'
          ]);
          $user->username = $request->username;
          $flag = TRUE;
        }
        if(($user->email != $request->email) && ($request->email !=null)) {
          $this->validate($request,[
            'email' => 'required|string|email|max:255|unique:users'
          ]);
          $user->email = $request->email;
          $flag = TRUE;
        }
        
        if($user->country_id != $request->county_id) {
          $user->country_id = $request->county_id;
          $flag = TRUE;
        }
        
        if($user->gender != $request->gender) {
          $user->gender = $request->gender;
          $flag = TRUE;
        }

        if ($request->photo!=null){
          $flag = TRUE;
          $user->picture = $user->id;
          $picture = $request->photo;
          Storage::disk('users')->put($user->id, file_get_contents($picture->getRealPath()));
        }
        if(($request->password != null)&&($request->password ===$request->confirmPassword)) {
          $user->password = bcrypt($request->password);
          $flag = TRUE;
        }

        if ($flag == TRUE){
          $user->save();
        }
        return redirect('users/'.$user->username);
      }

    public function showSettings() {
      $user = Auth::user();
      $sections = Section::all();
      $userSections = User::getUserSections($user);
      $userNotifs = User::getUserNoti($user);
      return view('pages.settings', ['sections' => $sections, 'userSections' => $userSections, 'userNotifs' => $userNotifs]);
    }

   

   

    public function addInterest(Request $request) {
      $status_code = 200;
      $current = DB::select('SELECT 1 FROM UserInterests
                  WHERE user_id = ? AND section_id = ?', [Auth::user()->id, $request->interest_id]);
      
      if (count($current) > 0) {
        $response = ['added' => false];
        return Response::JSON($response, $status_code);
      }
      
      $new = DB::insert('INSERT INTO UserInterests (user_id, section_id)
                    VALUES (?, ?);', [Auth::user()->id, $request->interest_id]);
      $section = Section::find($request->interest_id);
      $response = ['added' => true, 'section' => $section];
      return Response::JSON($response, $status_code);
    }

    public function removeInterest(Request $request) {
      $status_code = 200;
      $removed = DB::delete('DELETE FROM UserInterests
                              WHERE user_id = ? AND section_id = ?', [Auth::user()->id, $request->interest_id]);
      $response = ['removed' => $removed];
      return Response::JSON($response, $status_code);
    }
}