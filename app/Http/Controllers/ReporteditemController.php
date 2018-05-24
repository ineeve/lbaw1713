<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use App\Reporteditem;
use App\User;
class ReporteditemController extends Controller
{

    public function showReport($id) {
        $this->authorize('mod', \Auth::user());
        //get All news Reports
        // $reports = $this->queryArticleReports(0);
        // $commentsReports = $this->queryCommentsReports(0);
        // print_r($reports);
        $separate =  DB::select('SELECT news_id, comment_id FROM reporteditems WHERE id = ?',[$id]);
        if($separate == null) return redirect('error/404');
        if($separate[0]->news_id != null){
            $news_id = $separate[0]->news_id;
            return $this->showReportOfNews($news_id);
        } elseif($separate[0]->comment_id != null){
            $comment_id = $separate[0]->comment_id;
            return $this->showReportOfComments($comment_id);
        }
        return redirect('error/404');
    }

    public function showReportOfNews($news_id) {
        $this->authorize('mod', \Auth::user());
        $info =  DB::select('SELECT title, date, author_id, news.id, username FROM news JOIN users ON (author_id = users.id) WHERE news.id = ?',[$news_id]);

        $descriptions = DB::select('SELECT description FROM reporteditems WHERE news_id = ?',[$news_id]);

        $comments = DB::select('SELECT  news_id, moderatorcomments.id, text, date, username AS commentator, Users.picture AS commentator_picture FROM moderatorcomments JOIN users ON(creator_user_id = users.id) WHERE news_id = ? ORDER BY date DESC',[$news_id]);

        $reasons = DB::select('SELECT reason, count(*) AS number FROM reasonsforreport WHERE reported_item_id IN ( SELECT id FROM reporteditems WHERE news_id = ?) GROUP BY reason',[$news_id]);
        $route_mod_comment = '/api/news/'.$news_id.'/mod/create_comment';
        return view('pages.report',['comments' => $comments, 'reasons' => $reasons, 'descriptions' => $descriptions, 'info' => $info[0],'route_mod_comment'=>$route_mod_comment]);
    }
    public function showReportOfComments($comment_id) {
        $this->authorize('mod', Auth::user());
        $info =  DB::select('SELECT target_news_id AS news_id, comments.id AS title, date, creator_user_id, username FROM comments JOIN users ON (creator_user_id = users.id) WHERE comments.id = ?',[$comment_id]);

        $descriptions = DB::select('SELECT description FROM reporteditems WHERE comment_id = ?',[$comment_id]);

        $comments = DB::select('SELECT  news_id, comment_id, moderatorcomments.id, text, date, username AS commentator, Users.picture AS commentator_picture FROM moderatorcomments JOIN users ON(creator_user_id = users.id) WHERE comment_id = ? ORDER BY date DESC',[$comment_id]);

        $reasons = DB::select('SELECT reason, count(*) AS number FROM reasonsforreport WHERE reported_item_id IN ( SELECT id FROM reporteditems WHERE comment_id = ?) GROUP BY reason',[$comment_id]);
    
        $route_mod_comment = '/api/news/'.$info[0]->news_id.'/comments/'.$comment_id.'/mod/create_comment';
        return view('pages.report',['comments' => $comments, 'reasons' => $reasons, 'descriptions' => $descriptions, 'info' => $info[0],'route_mod_comment'=>$route_mod_comment]);
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
      //TODO CHANGE
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

    public function show() {
        $this->authorize('mod', \Auth::user());
        //get All news Reports
        $reports = $this->queryArticleReports(0);
        $commentsReports = $this->queryCommentsReports(0);
        // print_r($reports);
        $currentPageNews = 1;
        $currentPageComments = 1;
        $numberNews = $this->totalNews()/5;
        $numberComments = $this->totalComments()/5;
        return view('pages.reports',['newsreports' => $reports, 'commentreports' => $commentsReports,'currentPageNews'=>$currentPageNews,'currentPageComments'=>$currentPageComments,'numberOfPagesNews'=>$numberNews,'numberOfPagesComments'=>$numberComments]);
    }
    
    public function getReports() {
        $this->authorize('mod', \Auth::user());
        $report_offset = Input::get('offset');
        $reports = $this->queryArticleReports($report_offset);
        $report_offset = $report_offset + count($reports);
        $status_code = 200; // TODO: change if not found!
        $currentPageNews = ($report_offset/5);
        $numberOfPagesNews = $this->totalNews()/5;
        $data = [
            'view' => View::make('partials.reports_list')
                ->with('newsreports', $reports)
                ->render(),
            'offset' => $report_offset,
            'nav_news' => View::make('partials.nav_news')
            ->with('currentPageNews', $currentPageNews)
            ->with('numberOfPagesNews', $numberOfPagesNews)
            ->render()
        ];
        return Response::json($data, $status_code);
      }
      public function getReportsComments() {
        $this->authorize('mod', \Auth::user());
        $report_offset = Input::get('offset');
        $reports = $this->queryCommentsReports($report_offset);
        $report_offset = $report_offset + count($reports);
        $status_code = 200; // TODO: change if not found!
        $currentPageComments = ($report_offset/5);
        $numberOfPagesComments = $this->totalComments()/5;
        $data = [
            'view' => View::make('partials.report_list_comment')
                ->with('commentreports', $reports)
                ->render(),
            'offset' => $report_offset,
            'nav_comments' => View::make('partials.nav_comments')->with('currentPageComments', $currentPageComments)
            ->with('numberOfPagesComments', $numberOfPagesComments)
            ->render()
        ];
        return Response::json($data, $status_code);
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
}
