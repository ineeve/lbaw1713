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
    
    public function show()
    {

      $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
      FROM users NATURAL JOIN countries
      WHERE users.id = ?;',[Auth::user()->id]);

      if(count($user) == 0) {
        return redirect('/error/404');
      }
      $user = $user[0];

      return view('pages.profile', ['user' => $user]);
    }

   
}