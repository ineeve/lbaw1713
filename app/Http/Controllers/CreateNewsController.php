<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CreateNewsController extends Controller
{
  
    public function show()
    {
      $sections = DB::select('SELECT * FROM Sections');

      return view('pages.create_news', ['sections' => $sections]);
    }

}