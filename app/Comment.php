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

  public function user() {
    return $this->belongsTo('App\User');
  }
static public function getComments(Request $request, $news_id){
  DB::select('SELECT Comments.id AS id,text, date, Users.username AS commentator, Users.picture AS commentator_picture
            FROM Comments, Users
            WHERE Comments.target_news_id = ? AND Comments.creator_user_id = Users.id
            AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id)
            ORDER BY date DESC LIMIT 10 OFFSET ?; ',[$news_id, $request->input('next_comment')]);

}
static public function markDeleted($comm_id){
  $deletedItems = DB::table('deleteditems')->where('comment_id', $comm_id)->get();
  if (count($deletedItems) > 0) {
  // item was already deleted
      return;
}
DB::insert('INSERT INTO DeletedItems (user_id, comment_id) VALUES (?, ?);', [Auth::user()->id, $comm_id]);
}
}