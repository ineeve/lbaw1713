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
        $separate =  Reporteditem::getReport($id);
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
        $info = Reporteditem::getInfo($news_id);

        $descriptions = Reporteditem::getDescriptions($news_id);

        $comments = Reporteditem::getComments($news_id);

        $reasons = Reporteditem::getReasons($news_id);
        $route_mod_comment = '/api/news/'.$news_id.'/mod/create_comment';
        return view('pages.report',['comments' => $comments, 'reasons' => $reasons, 'descriptions' => $descriptions, 'info' => $info[0],'route_mod_comment'=>$route_mod_comment]);
    }
    public function showReportOfComments($comment_id) {
        $this->authorize('mod', Auth::user());
        $info =  Reporteditem::getInfoC($comment_id);

        $descriptions = Reporteditem::getDescriptionsC($comment_id);

        $comments = Reporteditem::getCommentsC($comment_id);

        $reasons =  Reporteditem::getReasonsC($comment_id);
    
        $route_mod_comment = '/api/news/'.$info[0]->news_id.'/comments/'.$comment_id.'/mod/create_comment';
        return view('pages.report',['comments' => $comments, 'reasons' => $reasons, 'descriptions' => $descriptions, 'info' => $info[0],'route_mod_comment'=>$route_mod_comment]);
    }
      
    public function show() {
        $this->authorize('mod', \Auth::user());
        $reports = $this->queryArticleReports(0);
        $commentsReports = $this->queryCommentsReports(0);
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

     
}
