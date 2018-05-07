<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Reporteditem;
use App\User;
class ReporteditemController extends Controller
{

    public function queryArticleReports($offset) {
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY news_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT r.news_id, r.description, r.date AS reportDate, n.title, n.author_id, n.date AS newsDate, numberReports, u.username
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

    public function show() {
        $this->authorize('show', Reporteditem::class);
        //get All news Reports
        $reports = $this->queryArticleReports(0);
        $commentsReports = $this->queryCommentsReports(0);
        // print_r($reports);
        return view('pages.reports',['newsreports' => $reports, 'commentreports' => $commentsReports]);
    }
    
    public function getReports() {
        $report_offset = Input::get('offset');
        $reports = $this->queryArticleReports($report_offset);
        $report_offset = $report_offset + count($reports);
        $status_code = 200; // TODO: change if not found!
        $data = [
            'view' => View::make('partials.reports_list')
                ->with('newsreports', $reports)
                ->render(),
            'offset' => $report_offset
        ];
        return Response::json($data, $status_code);
      }
      public function getReportsComments() {
        $report_offset = Input::get('offset');
        $reports = $this->queryCommentsReports($report_offset);
        $report_offset = $report_offset + count($reports);
        $status_code = 200; // TODO: change if not found!
        $data = [
            'view' => View::make('partials.report_list_comment')
                ->with('commentreports', $reports)
                ->render(),
            'offset' => $report_offset
        ];
        return Response::json($data, $status_code);
      }

      public function queryCommentsReports($offset) {
        return DB::select(';WITH r AS
        (
           SELECT *, ROW_NUMBER() OVER (PARTITION BY comment_id ORDER BY date DESC) AS rn
           FROM reporteditems
        )
        SELECT r.comment_id AS commentid, r.description, r.date AS reportDate, 
			n.id, n.creator_user_id, n.date AS commentDate,
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
