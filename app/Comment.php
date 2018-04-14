<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  // Don't add create and update timestamps in database.
  public $timestamps  = false;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'text', 'creator_user_id', 'target_news_id'
  ];

  public function news() {
    return $this->belongsTo('App\News');
  }

}