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
        $reports = DB::select('SELECT * FROM reporteditems JOIN news ON(news.id=reporteditems.news_id)
        JOIN users ON(news.author_id=users.id)WHERE comment_id IS NULL');
        return view('pages.reports',['reports' => $reports]);
    }
}
