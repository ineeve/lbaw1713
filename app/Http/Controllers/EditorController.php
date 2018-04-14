<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\News as News;
use App\Section as Section;

class EditorController extends Controller
{
  
    public function createArticle() {
      $sections = Section::pluck('name', 'id');

      return view('pages.news_editor', ['sections' => $sections]);
    }

    public function editArticle($id) {
      $sections = Section::pluck('name', 'id');
      $article = News::find($id);
      $this->authorize('editArticle', $article);
      // TODO; autorize
      return view('pages.news_editor', ['sections' => $sections, 'article' => $article]);
    }

}