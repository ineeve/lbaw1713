<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Storage;
use Image;
use \stdClass;

use App\News as News;
use App\Section as Section;
use App\Source as Source;

class NewsController extends Controller
{
    const DEFAULT_IMAGE_NAME = 'default';

    const MOST_POPULAR = 'POPULAR';
    const MOST_RECENT = 'RECENT';
    const MOST_VOTED = 'VOTED';

    private function getNewsByPopularity($section, $offset) {
      if(strcmp($section, 'All') == 0) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?', [$offset]);
      } else {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?', [$section, $offset]);
      }
    }

    private function getNewsByDate($section, $offset) {
      if(strcmp($section, 'All') == 0) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
          ORDER BY date DESC LIMIT 10 OFFSET ?', [$offset]);
      } else {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
          ORDER BY date DESC LIMIT 10 OFFSET ?', [$section, $offset]);
      }
    }

    private function getNewsByVotes($section, $offset) {
      if(strcmp($section, 'All') == 0) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
            ORDER BY votes DESC LIMIT 10 OFFSET ?', [$offset]);
      } else {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
          ORDER BY votes DESC LIMIT 10 OFFSET ?', [$section, $offset]);
      }
    }

    /**
      * @param  String  $order Either 'POPULAR', 'RECENT' or 'VOTED'.
      */
    private function getNews($section, $order, $offset) {
      switch ($order) {
        case self::MOST_POPULAR:
          return $this->getNewsByPopularity($section, $offset);
        case self::MOST_RECENT:
          return $this->getNewsByDate($section, $offset);
        case self::MOST_VOTED:
          return $this->getNewsByVotes($section, $offset);
      }
    }


    private function getOrderedPreviews() {
      switch ($this->current_order) {
        case self::MOST_POPULAR:
          $news = $this->getNewsByPopularity();
          break;
        case self::MOST_RECENT:
          $news = $this->getNewsByDate();
          break;
        case self::MOST_VOTED:
          $news = $this->getNewsByVotes();
          break;
        default:
          // return redirect('error/404');
      }

      return $news;
    }


    public function list($section = 'All', $order = self::MOST_POPULAR, $offset = 0) {
      //$this->authorize('list', News::class);
      //echo($section.";".$order.";".$offset);
      $news = $this->getNews($section, $order, $offset);
      $sections = DB::select('SELECT icon, name FROM Sections');

      return view('partials.news_item_preview_list', ['news' => $news, 'sections' => $sections]);
    }

    public function getNewsHomepage() {
      $news = $this->getNews('All', self::MOST_POPULAR, 0);
      $sections = DB::select('SELECT icon, name FROM Sections');

      return view('pages.news', ['news' => $news, 'sections' => $sections]);
    }

    public function show($id)
    {

      $news = DB::select('SELECT News.id, title, author_id, date, body, image, votes, Sections.name AS section, Users.username AS author
      FROM News, Sections, Users
      WHERE News.id  = ? AND Sections.id = News.section_id AND Users.id = News.author_id AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE DeletedItems.news_id = News.id)',[$id]);

      if(count($news)==0) {
        return redirect('/error/404');
      }
      $news = $news[0];

      $sources = DB::select('SELECT *
                              FROM Sources
                                INNER JOIN NewsSources ON Sources.id = NewsSources.source_id
                              WHERE NewsSources.news_id = ?', [$news->id]);

      return view('pages.news_item', ['news' => $news, 'sources' => $sources]);
    }

    /**
     * Get a validator for an incoming news creation;
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'section_id' => 'required|integer',
            'image' => 'nullable|image',
            'author_id' => 'integer',
            'body' => 'string|required'
        ]);
    }

    /**
     * Get a validator for the sources of an incoming news creation;
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function sourceValidator(array $data)
    {
        return Validator::make($data, [
            'author' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer',
            'link' => 'url'
        ]);
    }


    public function create(Request $request) {
      
      $validator = $this->validator($request->all());
      if ($validator->fails()) {
        echo 'errors found, redirecting';
        return redirect('/news/create')
                    ->withErrors($validator)
                    ->withInput();
      }
      $num_sources = count($request->link);

      $news = News::create([
          'title' => $request->title,
          'body' => $request->body,
          'section_id' => $request->section_id,
          'author_id' => Auth::user()->id,
          'image' => self::DEFAULT_IMAGE_NAME
      ]);

      if ($request->image != NULL){
        Image::make(file_get_contents($request->image->getRealPath()))->resize(100, 100)->save('storage/news/'.$news->id);
        $news->image = $news->id;
        $news->save();
      }


      for($i = 0; $i < $num_sources; $i++){
        $extLink = $this->externalLink($request->link[$i]);
        $sourceValidator = $this->sourceValidator(['author' => $request->author[$i],
                              'publication_year' => $request->publication_year[$i],
                              'link' => $extLink]);
        if ($sourceValidator->fails()) {
          echo 'errors found, redirecting';
          return redirect('/news/create')
                      ->withErrors($sourceValidator)
                      ->withInput();
        }
        $created_source = Source::create([
          'author' => $request->author[$i],
          'publication_year' => $request->publication_year[$i],
          'link' => $extLink
          ]);
        DB::table('newssources')->insert(['news_id' => $news->id, 'source_id' => $created_source->id ]);
      }
      
      return redirect('news/'.$news->id);
    }

    public function edit(Request $request, $id) {
      $article = News::find($id);
      $this->authorize('update', $article);
      $article->update($request->all());
      return redirect('news/'.$id);
    }
    
    public function destroy($id) {
      $article = News::find($id);
      $this->authorize('delete', $article);
      $this->markDeleted($article);
      return redirect('news');
    }


    ///////////////////// EDITOR BELOW

    private function getEmptySource(){
      $emptySource = new stdClass;
      $emptySource->author = ""; $emptySource->publication_year=""; $emptySource->link="";
      return $emptySource;
    }

    public function createArticle() {
      $this->authorize('create', News::class);
      $sections = Section::pluck('name', 'id');
      $sources = array($this->getEmptySource());
      return view('pages.news_editor', ['sections' => $sections, 'sources'=> $sources]);
    }

    public function editArticle($id) {
      $sections = Section::pluck('name', 'id');
      $article = News::find($id);
      $sources = DB::select('SELECT link,author,publication_year FROM 
        sources JOIN (SELECT * FROM newssources WHERE news_id=?) AS sourcesForANews ON sources.id = sourcesForANews.source_id',
        [$id]);
      $this->authorize('update', $article);
      return view('pages.news_editor', ['sections' => $sections, 'article' => $article, 'sources' => $sources]);
    }

    //////////////////// EDITOR ABOVE

    /**
     * Inserts article in the DeletedItems table rather than actually deleting it.
     */
    private function markDeleted($article) {
      $deletedItems = DB::table('deleteditems')->where('news_id', $article->id)->get();
      if (count($deletedItems) > 0) {
        // item was already deleted
        return;
      }
      DB::insert('INSERT INTO DeletedItems (user_id, news_id) VALUES (?, ?);', [Auth::user()->id, $article->id]);
    }

    /**
     * Preprends "http://" to a string if it doesn't already begin with "http://" or "https://".
     */
    private function externalLink($url) {
      if (substr($url, 0, strlen("http://")) !== "http://"
            && substr($url, 0, strlen("https://")) !== "https://") {
        $url = "http://" . $url;
      }
      return $url;
    }
}