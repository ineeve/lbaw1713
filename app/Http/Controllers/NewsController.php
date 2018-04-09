<?php

namespace App\Http\Controllers;

use App\Item;
use App\Card;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
  
    public function show()
    {
        return view('pages.news');
    }

    public function create(Request $request)
    {
      $card = new Card();
      return $card;
    }
}
