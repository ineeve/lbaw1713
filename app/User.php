<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'gender', 'country_id', 'picture'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

      /**
     * The news this user owns.
     */
     public function news() {
        return $this->hasMany('App\News');
      }
        /**
     * The notification of this user.
     */
    public function notifications() {
        return $this->hasMany('App\Notification', 'target_user_id','id');
    }

    public function following($username) {
        $result = count(DB::select('SELECT * FROM users WHERE EXISTS (SELECT users.username
        FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
        WHERE users.username = ? AND EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id));',[$username, $this->username]));
        return $result != 0;
    }

    public function ban() {
        return $this->hasMany('App\Ban','banned_user_id'); // 0 or 1
    }

    static public function searchUsers($name, $offset){
        return DB::select("SELECT users.id, username, picture
        FROM users WHERE LOWER(users.username) LIKE '%{$name}%'
        ORDER BY username DESC LIMIT 20 OFFSET ?;",[$offset]);
    }
    static public function getCountries(){
        return DB::select('SELECT * FROM countries');;
    }
    static public function queryUser($username) {
        $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
        FROM Users LEFT JOIN Countries ON country_id = Countries.id
        WHERE Users.username = ?;',[$username]);
  
        if(count($user) == 0) {
          return redirect('/error/404');
        }
  
        return $user[0];
  
      }
  
      static public function queryArticles($username, $offset) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
        FROM News INNER JOIN Users ON (News.author_id = Users.id)
                    WHERE Users.username = ? AND
                          NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
                    ORDER BY date DESC LIMIT 5 OFFSET ?;',[$username, $offset]);
      }
  
      static public function queryAllArticles($username) {
        return DB::select('SELECT *
        FROM News INNER JOIN Users ON (News.author_id = Users.id)
                    WHERE Users.username = ? AND
                          NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id);',[$username]);
      }
  
      static public function queryFollowing($username, $offset) {
        return DB::select('SELECT users.id, username, picture
        FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
        WHERE EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id)
        ORDER BY username DESC LIMIT 5 OFFSET ?;',[$username, $offset]);
      }
  
      static public function queryAllFollowing($username) {
        return DB::select('SELECT *
        FROM users INNER JOIN follows ON users.id = follows.followed_user_id 
        WHERE EXISTS (SELECT users.id FROM users WHERE users.username = ? AND users.id = follows.follower_user_id);',[$username]);
      }
  
      static public function queryBadges($username, $offset) {
        return DB::select('SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
        JOIN users ON users.id = achievements.user_id
        WHERE users.username = ? LIMIT 6 OFFSET ?;',[$username, $offset]);
      }
  
      static public function queryNthBadges($username, $n) {
        return DB::select('SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
        JOIN users ON users.id = achievements.user_id
        WHERE users.username = ? LIMIT ? OFFSET 0;',[$username, $n]);
      }
      static public function countBadges(){
          return DB::select('SELECT count(*)
          FROM badges;');
      }
      static public function getUser($user_id){
    
      return DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
        FROM users NATURAL JOIN countries
        WHERE users.id = ?;',[$user_id]);
      }
      static public function insertFollowing($user){
        DB::insert('INSERT INTO Follows (follower_user_id, followed_user_id)
                    VALUES (?, ?)', [Auth::user()->id, $user->id]);
      }
      static public function deleteFollowing($user){
        DB::insert('DELETE FROM Follows
      WHERE follower_user_id = ? AND followed_user_id = ?', [Auth::user()->id, $user->id]);
      }

      static public function getUserSections($user){
        return DB::select('SELECT *
        FROM Sections
          INNER JOIN UserInterests ON Sections.id = UserInterests.section_id
        WHERE UserInterests.user_id = ?', [$user->id]);
      }

      static public function getUserNoti($user){
        return DB::table('settingsnotifications')->where('user_id', $user->id)->pluck('type');
      }
       /**
     * $notification in notification type domain ['CommentMyPost', 'FollowMe', 'VoteMyPost', 'FollowedPublish']
     */
    public function deactivateNotification($notification) {
      DB::insert('DELETE FROM SettingsNotifications
                    WHERE type = ? AND user_id = ?', [$notification, Auth::user()->id]);
    }

     /**
     * $notification in notification type domain ['CommentMyPost', 'FollowMe', 'VoteMyPost', 'FollowedPublish']
     */
    public function activateNotification($notification) {
      DB::insert('INSERT INTO SettingsNotifications (type, user_id)
                    VALUES (?, ?)', [$notification, Auth::user()->id]);
    }

    static public function userInterest($request) {
      return DB::select('SELECT 1 FROM UserInterests
      WHERE user_id = ? AND section_id = ?', [Auth::user()->id, $request->interest_id]);
    }
    static public function insertuserInterest($request) {
      return DB::insert('INSERT INTO UserInterests (user_id, section_id)
      VALUES (?, ?);', [Auth::user()->id, $request->interest_id]);
    }
    static public function deleteuserInterest($request) {
      return DB::delete('DELETE FROM UserInterests
      WHERE user_id = ? AND section_id = ?', [Auth::user()->id, $request->interest_id]);
    }
}