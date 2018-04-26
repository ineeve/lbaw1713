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
        $reports = DB::select('SELECT news.title, users.username, news.date AS date, count(reporteditems.id) AS reports_number 
		FROM reporteditems 
        JOIN news ON(news.id = reporteditems.news_id)
        JOIN users ON(news.author_id=users.id)
		JOIN reporteditems AS r ON(reporteditems.id=r.id)
        WHERE reporteditems.comment_id IS NULL
        GROUP BY users.username, news.title, news.date
        ORDER BY COUNT(reporteditems.id) DESC;');
        return view('pages.reports',['reports' => $reports]);
    }
}
