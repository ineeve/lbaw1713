<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

use Illuminate\Support\Facades\DB;
class Reporteditem extends Model
{
    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    public function news() {
        return $this->belongsTo('App\News');
    }

    static public function getReport($id){
        return DB::select('SELECT news_id, comment_id FROM reporteditems WHERE id = ?',[$id]);
    }
    static public function getInfo($news_id){
        return  DB::select('SELECT title, date, author_id, news.id, username FROM news JOIN users ON (author_id = users.id) WHERE news.id = ?',[$news_id]);
    }
    static public function getInfoC($comment_id){
        return  DB::select('SELECT target_news_id AS news_id, comments.id AS title, date, creator_user_id, username FROM comments JOIN users ON (creator_user_id = users.id) WHERE comments.id = ?',[$comment_id]);
    }
    static public function getDescriptions($news_id){
        return  DB::select('SELECT description FROM reporteditems WHERE news_id = ?',[$news_id]);
    }

    static public function getComments($news_id){
        return  DB::select('SELECT  news_id, moderatorcomments.id, text, date, username AS commentator, Users.picture AS commentator_picture FROM moderatorcomments JOIN users ON(creator_user_id = users.id) WHERE news_id = ? ORDER BY date DESC',[$news_id]);
    }
    public function queryCommentsReports($offset) {
        $this->authorize('mod', \Auth::user());
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY comment_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT r.comment_id AS commentid, r.description, r.date AS reportDate, 
			r.id, n.creator_user_id, n.date AS commentDate,
			numberReports, u.username, n.target_news_id AS news_id
        FROM r
        JOIN comments AS n ON (r.comment_id = n.id)
        JOIN users AS u ON (n.creator_user_id = u.id)
        JOIN (SELECT r.comment_id, count(r.id) AS numberReports
            FROM reporteditems AS r 
            WHERE (r.news_id IS NULL)
            GROUP BY r.comment_id
            ORDER BY r.comment_id)
            AS b ON (b.comment_id = r.comment_id)
        WHERE rn = 1
        LIMIT 5 OFFSET ?;
        ',[$offset]);
      }
    static public function getReasons($news_id){
        return   DB::select('SELECT reason, count(*) AS number FROM reasonsforreport WHERE reported_item_id IN ( SELECT id FROM reporteditems WHERE news_id = ?) GROUP BY reason',[$news_id]);
    }

    public function queryArticleReports($offset) {
        $this->authorize('mod', \Auth::user());
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY news_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT r.news_id, r.description, r.date AS reportDate, r.id, n.title, n.author_id, n.date AS newsDate, numberReports, u.username
        FROM r
        JOIN news AS n ON (r.news_id = n.id)
        JOIN users AS u ON (n.author_id = u.id)
        JOIN (SELECT r.news_id, count(r.id) AS numberReports
            FROM reporteditems AS r 
            WHERE (r.comment_id IS NULL)
            GROUP BY r.news_id
            ORDER BY r.news_id)
            AS b ON (b.news_id = r.news_id)
        WHERE rn = 1
        LIMIT 5 OFFSET ?;
        ',[$offset]);
      }
      public function totalNews() {
        $this->authorize('mod', \Auth::user());
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY news_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT count(*) AS n
        FROM r
        JOIN news AS n ON (r.news_id = n.id)
        JOIN users AS u ON (n.author_id = u.id)
        JOIN (SELECT r.news_id, count(r.id) AS numberReports
            FROM reporteditems AS r 
            WHERE (r.comment_id IS NULL)
            GROUP BY r.news_id
            ORDER BY r.news_id)
            AS b ON (b.news_id = r.news_id)
        WHERE rn = 1;
        ')[0]->n;
      }
      public function totalComments() {
        $this->authorize('mod', \Auth::user());
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY comment_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT count(*) AS n
        FROM r
        JOIN comments AS n ON (r.comment_id = n.id)
        JOIN users AS u ON (n.creator_user_id = u.id)
        JOIN (SELECT r.comment_id, count(r.id) AS numberReports
            FROM reporteditems AS r 
            WHERE (r.news_id IS NULL)
            GROUP BY r.comment_id
            ORDER BY r.comment_id)
            AS b ON (b.comment_id = r.comment_id)
        WHERE rn = 1;
        ')[0]->n;
      }

      static public function getDescriptionsC($comment_id){
        return DB::select('SELECT description FROM reporteditems WHERE comment_id = ?',[$comment_id]);
    }

    static public function getCommentsC($comment_id){
        return DB::select('SELECT  news_id, comment_id, moderatorcomments.id, text, date, username AS commentator, Users.picture AS commentator_picture FROM moderatorcomments JOIN users ON(creator_user_id = users.id) WHERE comment_id = ? ORDER BY date DESC',[$comment_id]);
    }
    static public function getReasonsC($comment_id){
        return DB::select('SELECT reason, count(*) AS number FROM reasonsforreport WHERE reported_item_id IN ( SELECT id FROM reporteditems WHERE comment_id = ?) GROUP BY reason',[$comment_id]);
    }

    static public function getreportReasons(){
        return DB::select('SELECT unnest(enum_range(NULL::reason_type))');
    }
    static public function insertDeleted($article){
        DB::insert('INSERT INTO DeletedItems (user_id, news_id) VALUES (?, ?);', [Auth::user()->id, $article->id]);
    }

    static public function getReportedItemId($comment_id,$brief){
        return DB::table('reporteditems')->insertGetId([
            'user_id' => Auth::user()->id, 'comment_id' => $comment_id, 'description' => $brief
          ]);
    }

    static public function getReportedItemIdN($news_id,$brief){
        return DB::table('reporteditems')->insertGetId([
            'user_id' => Auth::user()->id, 'news_id' => $news_id, 'description' => $brief
          ]);
    }

    static public function insertReason($reason, $reported_item_id){
        DB::table('reasonsforreport')->insert([
            'reason' => $reason, 'reported_item_id' => $reported_item_id
          ]);
    }
}
