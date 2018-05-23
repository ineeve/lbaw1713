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

    public function ban(){
        return $this->hasMany('App\Ban','banned_user_id'); //0 or 1
    }

}
