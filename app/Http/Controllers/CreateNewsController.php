<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\News as News;
use App\Section as Section;

class CreateNewsController extends Controller
{
  
    public function show() {
      $sections = Section::pluck('name', 'id');

      return view('pages.create_news', ['sections' => $sections]);
    }

    public function editCurrent($id) {
      $sections = Section::pluck('name', 'id');
      $article = News::find($id);
      // TODO: Authorize
      return view('pages.create_news', ['sections' => $sections, 'article' => $article]);
    }

}