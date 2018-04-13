<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


use App\News as News;

class NewsController extends Controller
{
  
    public function list()
    {
      //$this->authorize('list', News::class);

      $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview FROM news JOIN users ON news.author_id = users.id
                          -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
                          LIMIT 10 OFFSET 0');

      $sections = DB::select('SELECT icon, name FROM Sections');

      //TODO: alter query
      return view('pages.news', ['news' => $news, 'sections' => $sections]);
    }

    public function list_section($section_id)
    {
      //$this->authorize('list', News::class);

      $news =  DB::select('SELECT title, date, body, image, votes, Sections.name, Users.username
    FROM News, Sections, Users
    WHERE Sections.id = News.section_id AND Users.id = News.author_id AND Sections.name = $section
    AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
    ORDER BY date DESC LIMIT 10 OFFSET $offset;',[$section, $request->input('next_comment')]);
      //TODO: alter query
      return view('pages.news', ['news' => $news]);
    }

    public function show($id)
    {

      $news = DB::select('SELECT News.id, title, author_id, date, body, image, votes, Sections.name AS section, Users.username AS author
      FROM News, Sections, Users
      WHERE News.id  = ? AND Sections.id = News.section_id AND Users.id = News.author_id AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id)',[$id]);

      //TODO: check if exists;
      $news = $news[0];

      $sources = DB::select('SELECT *
                              FROM Sources
                                INNER JOIN NewsSources ON Sources.id = NewsSources.source_id
                              WHERE NewsSources.news_id = ?', [$news->id]);

      return view('pages.news_item', ['news' => $news, 'sources' => $sources]);
    }

    public function create(Request $request) {
      $request['author_id'] = Auth::user()->id;
      $news = News::create($request->all());
      
      return redirect('news/'.$news->id);
    }

}
