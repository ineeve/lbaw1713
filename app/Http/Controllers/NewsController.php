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

use App\Reporteditem;

class NewsController extends Controller
{
    const DEFAULT_IMAGE_NAME = 'default';

    const MOST_POPULAR = 'POPULAR';
    const MOST_RECENT = 'RECENT';
    const MOST_VOTED = 'VOTED';


    /**
      * @param  String  $order Either 'POPULAR', 'RECENT' or 'VOTED'.
      */
    private function getNews($section, $order, $offset, $direction) {
      switch ($order) {
        case self::MOST_POPULAR:
          return News::getNewsByPopularity($section, $offset, $direction);
        case self::MOST_RECENT:
          return $this->getNewsByDate($section, $offset, $direction);
        case self::MOST_VOTED:
          return $this->getNewsByVotes($section, $offset, $direction);
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

    public function list(Request $request, $section = 'All', $order = self::MOST_POPULAR, $offset = 0) {
      $reversed = $request->reversed;
      if($reversed == "true"){
        $direction = "ASC";
      }else{
        $direction = "DESC";
      }
      $news = $this->getNews($section, $order, $offset, $direction);
      $sections = News::getSections();

      return view('partials.news_item_preview_list', ['news' => $news, 'sections' => $sections]);
    }

    public function listSearch(Request $request, $order = self::MOST_POPULAR, $offset = 0) {
      $news = $this->searchNews($request->searchText, $order, $offset);
      return view('partials.news_item_preview_list', ['news' => $news]);
    }

    public function getNewsHomepage() {
      if (Auth::check()) {
        $initial_page = 'For You';
      } else {
        $initial_page = 'All';
      }
      $news = $this->getNews($initial_page, self::MOST_POPULAR, 0, "DESC");
      $sections = News::getSections();
      
      return view('pages.news', ['news' => $news, 'sections' => $sections, 'currentSection' => $initial_page]);
    }

    public function show($id) {

      $news = News::getArticle($id);

      if(count($news)==0) {
        return redirect('/error/404');
      }
      $news = $news[0];

      $sources = News::getSources($news->id);
      $reportReasons = array_column(Reporteditem::getreportReasons(),'unnest');

      return view('pages.news_item', ['news' => $news, 'sources' => $sources, 'reportReasons'=> $reportReasons]);
    }

    /**
     * Get a validator for an incoming news creation;
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
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
    protected function sourceValidator(array $data) {
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
        News::insertSource($news->id,$created_source->id);
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
      $sources = Reporteditem::selectSources($id);
      $this->authorize('update', $article);
      return view('pages.news_editor', ['sections' => $sections, 'article' => $article, 'sources' => $sources]);
    }

    //////////////////// EDITOR ABOVE

    /**
     * Inserts article in the DeletedItems table rather than actually deleting it.
     */
    private function markDeleted($article) {
      $deletedItems = News::getDelected($article);
      if (count($deletedItems) > 0) {
        // item was already deleted
        return;
      }
      Reporteditem::insertDeleted($article);
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
      $validReasons = array_column(Reporteditem::getreportReasons(),'unnest');
      $success = False;
      //check news is valid and check comment belongs to news.
      if (is_null($brief)) {
        $brief = '';
      }
      $reported_item_id = -1;
      if (News::newsExist($news_id)) {
        if (!is_null($comment_id)) {
          if (Comment::commentExist($news_id)){
            $reported_item_id = Reporteditem::getReportedItemId($comment_id,$brief);
            $success = True;
          }
        } else {
          $reported_item_id = Reporteditem::getReportedItemId($news_id,$brief);
          $success = True;
        }
      }
      if ($reported_item_id != -1){
        $reasons = explode(",",$reasons);
        foreach($reasons as $reason){
          if (in_array($reason, $validReasons)){
            Reportitem::insertReason($reason, $reported_item_id);
          }else{
            $success = False;
          }
        }
      }
      echo json_encode($success);
      
    }
}