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
        $countries = DB::select('SELECT * FROM countries');
        return view('pages.profile_edit', ['countries' => $countries]);
    }
    
    public function show($username)
    {

      $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
      FROM users NATURAL JOIN countries
      WHERE users.username = ?;',[$username]);

      $total_badges = (DB::select('SELECT count(*)
      FROM badges;'))[0]->count;

      $achieved_badges = DB::select('SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
      JOIN users ON users.id = achievements.user_id
      WHERE users.username = ? LIMIT 6 OFFSET 0;',[$username]);

      $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
                  ORDER BY date DESC LIMIT 5 OFFSET 0;',[$username]);

      $count = count(DB::select('SELECT *
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id);',[$username])) - 5;

      $following = DB::select('SELECT users.id, username, picture
      FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
      WHERE EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id)
      ORDER BY username DESC LIMIT 5 OFFSET 0;',[$username]);

      if(count($user) == 0) {
        return redirect('/error/404');
      }
      $user = $user[0];
      
      $offset = 0;

      return view('pages.profile', ['user' => $user,
       'total_badges' => $total_badges,
       'achieved_badges' => $achieved_badges,
       'news' => $news,
       'count' => $count,
       'following' => $following,
       'offset' => $offset]);
    }

    public function getArticles($username) {
      $offset = Input::get('offset');
      $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
                  ORDER BY date DESC LIMIT 5 OFFSET ?;',[$username, $offset]);
      
      $count = count(DB::select('SELECT *
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id);',[$username])) - 5 - $offset;

      $status_code = 200; // TODO: change if not found!
      $data = [
          'view' => View::make('partials.news_item_preview_list')
              ->with('news', $news)
              ->render(),
          'count' => $count,
          'offset' => $offset
      ];

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

    public function showSettings($username) {
      $user = User::where('username', $username);
      return view('pages.settings', '');
    }
}
