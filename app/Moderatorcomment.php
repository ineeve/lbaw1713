<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moderatorcomment extends Model
{
      // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'text', 'creator_user_id', 'news_id','comment_id'
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }
}
