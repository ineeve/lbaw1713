<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
  
    public function show()
    {
      //$this->authorize('list', News::class);

      $news = DB::select('SELECT title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview FROM news JOIN users ON news.author_id = users.id
      -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
      LIMIT 10 OFFSET 0'
      );
      //TODO: alter query
      return view('pages.news', ['news' => $news]);
    }

    /**
     * Shows news
     *
     * @return Response
     */
    public function list()
    {
    //   if (!Auth::check()) return redirect('/login');

      $this->authorize('list', Card::class);

      $news = Auth::user()->news()->orderBy('id')->get();

      return view('pages.news', ['news' => $news]);
    }
}