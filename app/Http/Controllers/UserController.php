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

    public function queryUser($username) {
      $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
      FROM users NATURAL JOIN countries
      WHERE users.username = ?;',[$username]);

      if(count($user) == 0) {
        return redirect('/error/404');
      }

      return $user[0];

    }

    public function queryArticles($username, $offset) {
      return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
                  ORDER BY date DESC LIMIT 5 OFFSET ?;',[$username, $offset]);
    }

    public function queryAllArticles($username) {
      return DB::select('SELECT *
      FROM News INNER JOIN Users ON (News.author_id = Users.id)
                  WHERE Users.username = ? AND
                        NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id);',[$username]);
    }

    public function queryFollowing($username, $offset) {
      return DB::select('SELECT users.id, username, picture
      FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
      WHERE EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id)
      ORDER BY username DESC LIMIT 5 OFFSET ?;',[$username, $offset]);
    }

    public function queryAllFollowing($username) {
      return DB::select('SELECT *
      FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
      WHERE EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id);',[$username]);
    }

    public function queryBadges($username, $offset) {
      return DB::select('SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
      JOIN users ON users.id = achievements.user_id
      WHERE users.username = ? LIMIT 6 OFFSET ?;',[$username, $offset]);
    }
    
    public function show($username)
    {

      $user = $this->queryUser($username);

      $total_badges = (DB::select('SELECT count(*)
      FROM badges;'))[0]->count;

      $achieved_badges = $this->queryBadges($username, 0);

      $news = $this->queryArticles($username, 0);

      $articles_count = count($this->queryAllArticles($username)) - 5;

      $following = $this->queryFollowing($username, 0);

      $following_count = count($this->queryAllFollowing($username)) - 5;
      
      $articles_offset = 0;
      $following_offset = 0;

      return view('pages.profile', ['user' => $user,
       'total_badges' => $total_badges,
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
      $userSections = DB::select('SELECT *
                                    FROM Sections
                                      INNER JOIN UserInterests ON Sections.id = UserInterests.section_id
                                    WHERE UserInterests.user_id = ?', [$user->id]);
      $userNotifs = DB::table('settingsnotifications')->where('user_id', $user->id)->pluck('type');
      return view('pages.settings', ['sections' => $sections, 'userSections' => $userSections, 'userNotifs' => $userNotifs]);
    }

    /**
     * $notification in notification type domain ['CommentMyPost', 'FollowMe', 'VoteMyPost', 'FollowedPublish']
     */
    public function activateNotification($notification) {
      DB::insert('INSERT INTO SettingsNotifications (type, user_id)
                    VALUES (?, ?)', [$notification, Auth::user()->id]);
    }

    /**
     * $notification in notification type domain ['CommentMyPost', 'FollowMe', 'VoteMyPost', 'FollowedPublish']
     */
    public function deactivateNotification($notification) {
      DB::insert('DELETE FROM SettingsNotifications
                    WHERE type = ? AND user_id = ?', [$notification, Auth::user()->id]);
    }
}