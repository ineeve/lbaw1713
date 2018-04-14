<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
     * The cards this user owns.
     */
    public function cards() {
        return $this->hasMany('App\Card');
      }
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
}
