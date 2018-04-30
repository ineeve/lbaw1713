<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Reporteditem;
use App\User;
class ReporteditemController extends Controller
{
    public function show() {
        //get All news Reports
        $reports = DB::select(';WITH r AS
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
        WHERE rn = 1;
        ');
        // print_r($reports);
        return view('pages.reports',['reports' => $reports]);
    }
}
