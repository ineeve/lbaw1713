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

    private function searchNewsByPopularity($searchText, $offset) {
      return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
        FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
        ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
    }

    private function searchNewsByDate($searchText, $offset) {
      return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
        FROM news JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
        ORDER BY date DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
    }

    private function searchNewsByVotes($searchText, $offset) {
      return DB::select("SELECT news.id, title, users.username As author, date, votes, image, substring(body, '(?:<p>)[^<>]*\.(?:<\/p>)') as body_preview
        FROM news JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          AND textsearchable_body_and_title_index_col @@ plainto_tsquery('english',?)
        ORDER BY votes DESC LIMIT 10 OFFSET ?", [$searchText, $offset]);
    }

    private function getUserSectionsArray() {
      $userSections = DB::select('SELECT name
        FROM Sections
          INNER JOIN UserInterests ON Sections.id = UserInterests.section_id
        WHERE UserInterests.user_id = ?', [Auth::user()->id]);
      $userSectionsArray = [];
      for ($i = 0; $i < count($userSections); $i++) {
        array_push($userSectionsArray, $userSections[$i]->name);
      }
      return $userSectionsArray;
    }

    private function getQueryBindings($numBindings) {
      if ($numBindings == 0) {
        return "1 = 2 AND"; // impossible so no news are returned
      }
      return 'sections.name IN (' . implode(',', array_fill(0, $numBindings, '?')) . ') AND';
    }

    private function getNewsByPopularity($section, $offset) {
      if(strcmp($section, 'All') == 0) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
          WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?', [$offset]);
      } else if (strcmp($section, 'for_you') == 0) {
        $selectInputs = $this->getUserSectionsArray();
        $userSectionsBindings = $this->getQueryBindings(count($selectInputs));
        array_push($selectInputs, $offset);
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY newspoints.points DESC LIMIT 10 OFFSET ?', $selectInputs);
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
          ORDER BY date DESC LIMIT 10 OFFSET ?', [$offset]);
      } else if (strcmp($section, 'for_you') == 0) {
        $selectInputs = $this->getUserSectionsArray();
        $userSectionsBindings = $this->getQueryBindings(count($selectInputs));
        array_push($selectInputs, $offset);
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY date DESC LIMIT 10 OFFSET ?', $selectInputs);
      } else {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY date DESC LIMIT 10 OFFSET ?', [$section, $offset]);
      }
    }

    private function getNewsByVotes($section, $offset) {
      if(strcmp($section, 'All') == 0) {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
            FROM news JOIN users ON news.author_id = users.id
            WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
            ORDER BY votes DESC LIMIT 10 OFFSET ?', [$offset]);
      } else if (strcmp($section, 'for_you') == 0) {
        $selectInputs = $this->getUserSectionsArray();
        $userSectionsBindings = $this->getQueryBindings(count($selectInputs));
        array_push($selectInputs, $offset);
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news NATURAL JOIN newspoints JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE ' . $userSectionsBindings . ' NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
          ORDER BY votes DESC LIMIT 10 OFFSET ?', $selectInputs);
      } else {
        return DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview
          FROM news JOIN users ON news.author_id = users.id
            INNER JOIN sections ON news.section_id = sections.id
          WHERE sections.name = ? AND NOT EXISTS (SELECT * FROM DeletedItems WHERE DeletedItems.news_id = News.id)
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

    /**
      * @param  String  $order Either 'POPULAR', 'RECENT' or 'VOTED'.
      */
      private function searchNews($searchText, $order, $offset) {
        switch ($order) {
          case self::MOST_POPULAR:
            return $this->searchNewsByPopularity($searchText, $offset);
          case self::MOST_RECENT:
            return $this->searchNewsByDate($searchText, $offset);
          case self::MOST_VOTED:
            return $this->searchNewsByVotes($searchText, $offset);
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

    public function getSearchPage(Request $request){
      $searchText = $request->searchText;
      $filteredNews = $this->searchNewsByPopularity($searchText, 0);
      return view('pages.searched_news',['news'=> $filteredNews, 'searchText' => $searchText]);
    }

    public function list($section = 'All', $order = self::MOST_POPULAR, $offset = 0) {
      //$this->authorize('list', News::class);
      //echo($section.";".$order.";".$offset);
      $news = $this->getNews($section, $order, $offset);
      $sections = DB::select('SELECT icon, name FROM Sections');

      return view('partials.news_item_preview_list', ['news' => $news, 'sections' => $sections]);
    }

    public function listSearch(Request $request, $order = self::MOST_POPULAR, $offset = 0) {
      $news = $this->searchNews($request->searchText, $order, $offset);
      return view('partials.news_item_preview_list', ['news' => $news]);
    }

    public function getNewsHomepage() {
      if (Auth::check()) {
        $initial_page = 'for_you';
      } else {
        $initial_page = 'All';
      }
      $news = $this->getNews($initial_page, self::MOST_POPULAR, 0);
      $sections = DB::select('SELECT icon, name FROM Sections');
      
      return view('pages.news', ['news' => $news, 'sections' => $sections, 'currentSection' => $initial_page]);
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
      $reportReasons = array_column(DB::select('SELECT unnest(enum_range(NULL::reason_type))'),'unnest');

      return view('pages.news_item', ['news' => $news, 'sources' => $sources, 'reportReasons'=> $reportReasons]);
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
      if (Auth::user()->id == $article->author_id){
        $article->delete();
      }else{
        $this->markDeleted($article);
      }
      
      return redirect('news');
    }


    ///////////////////// EDITOR BELOW

    private function getEmptySource() {
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

    public function reportItem(Request $request, $news_id, $comment_id = NULL){
      $brief = $request->input('brief');
      $reasons = $request->input('reasons');
      $validReasons = array_column(DB::select('SELECT unnest(enum_range(NULL::reason_type))'),'unnest');
      $success = False;
      //check news is valid and check comment belongs to news.
      if (is_null($brief)) {
        $brief = '';
      }
      $reported_item_id = -1;
      if (DB::table('news')->where('id',$news_id)->exists()) {
        if (!is_null($comment_id)) {
          if (DB::table('comments')->where('id',$comment_id)->where('target_news_id',$news_id)->exists()){
            $reported_item_id = DB::table('reporteditems')->insertGetId([
              'user_id' => Auth::user()->id, 'comment_id' => $comment_id, 'description' => $brief
            ]);
            $success = True;
          }
        } else {
          $reported_item_id = DB::table('reporteditems')->insertGetId([
            'user_id' => Auth::user()->id, 'news_id' => $news_id, 'description' => $brief
          ]);
          $success = True;
        }
      }
      if ($reported_item_id != -1){
        $reasons = explode(",",$reasons);
        foreach($reasons as $reason){
          if (in_array($reason, $validReasons)){
            DB::table('reasonsforreport')->insert([
              'reason' => $reason, 'reported_item_id' => $reported_item_id
            ]);
          }else{
            $success = False;
          }
        }
      }
      echo json_encode($success);
      
    }
}