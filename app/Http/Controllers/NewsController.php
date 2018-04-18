<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Storage;

use App\News as News;
use App\Section as Section;

class NewsController extends Controller
{
    const DEFAULT_IMAGE_NAME = 'default';

    const MOST_POPULAR = 'POPULAR';
    const MOST_RECENT = 'RECENT';
    const MOST_VOTED = 'VOTED';

    private function getNewsByDate($offset) {
      return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
            ORDER BY date DESC LIMIT 10 OFFSET ?', [$offset]);
    }

    private function getNewsByVotes($offset) {
      return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            -- WHERE textsearchable_body_and_title_index_col @@ to_tsquery(title) 
            ORDER BY votes DESC LIMIT 10 OFFSET ?', [$offset]);
    }

    /**
     * @param  String  $order Either 'POPULAR', 'RECENT' or 'VOTED'.
     */
    public function changeOrder($order) {
      switch ($order) {
        case 'POPULAR':
          $news = $this->getNewsByPopularity(0);
          break;
        case 'RECENT':
          $news = $this->getNewsByDate(0);
          break;
        case 'VOTED':
          $news = $this->getNewsByVotes(0);
          break;
        default:
          return redirect('error/404');
      }

      $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
      $data = ['view' => $view];
      return $data;
    }

    public function list()
    {
      //$this->authorize('list', News::class);

      $news = $this->getNewsByDate(0); 
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
            'body' => 'string'
        ]);
    }


    public function create(Request $request) {
      
      $validator = $this->validator($request->all());
      if ($validator->fails()) {
        return redirect('/news/create')
                    ->withErrors($validator)
                    ->withInput();
      }
      $news = News::create([
          'title' => $request->title,
          'body' => $request->body,
          'section_id' => $request->section_id,
          'author_id' => Auth::user()->id,
          'image' => self::DEFAULT_IMAGE_NAME
      ]);

      if ($request->image != NULL){
        Storage::disk('news')->put(
          $news->id,
          file_get_contents($request->image->getRealPath())
        );
        $news->image = $news->id;
        $news->save();
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

    public function createArticle() {
      $this->authorize('create', News::class);
      $sections = Section::pluck('name', 'id');
      return view('pages.news_editor', ['sections' => $sections]);
    }

    public function editArticle($id) {
      $sections = Section::pluck('name', 'id');
      $article = News::find($id);
      $this->authorize('editArticle', $article);
      return view('pages.news_editor', ['sections' => $sections, 'article' => $article]);
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
}
