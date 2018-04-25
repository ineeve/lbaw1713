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

use App\User as User;

class UserController extends Controller
{
    public function edit() {
        $countries = DB::select('SELECT * FROM countries');
        return view('pages.profile_edit', ['countries' => $countries]);
    }
    
    public function show($username)
    {

      $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
      FROM users NATURAL JOIN countries
      WHERE users.username = ?;',[$username]);

      $total_badges = (DB::select('SELECT count(*)
      FROM badges;'))[0]->count;

      $achieved_badges = DB::select('SELECT badges.id as badge_id, name, brief, votes, comments, articles FROM badges JOIN achievements ON badges.id = achievements.badge_id
      JOIN users ON users.id = achievements.user_id
      WHERE users.username = ? LIMIT 6 OFFSET 0;',[$username]);

      if(count($user) == 0) {
        return redirect('/error/404');
      }
      $user = $user[0];

      return view('pages.profile', ['user' => $user,
       'total_badges' => $total_badges,
       'achieved_badges' => $achieved_badges]);
    }

   

    public function update(Request $request, $username) {
        $user = User::find($request->IDInput);
        $this->authorize('update', $user);
        // $user->update($request->all());

        $flag = FALSE;

        if(($user->username != $request->username) && ($request->username!=null)) {
          //TODO: validate unique
          $user->username = $request->username;
          $flag = TRUE;
        }
        if(($user->email != $request->email) && ($request->email !=null)) {
          
          //TODO: validate unique
          $user->email = $request->email;
          $flag = TRUE;
        }
        
        if($user->country_id != $request->county_id) {
          $user->country_id = $request->county_id;
          $flag = TRUE;
        }
        
        if($user->gender != $request->gender) {
          $user->gender = $request->gender;
          $flag = TRUE;
        }

        if ($request->photo!=null){
          $flag = TRUE;
          $user->picture = $user->id;
          $picture = $request->photo;
          Storage::disk('users')->put($user->id, file_get_contents($picture->getRealPath()));
        }
        if(($request->password != null)&&($request->password ===$request->confirmPassword)) {
          $user->password = bcrypt($request->password);
          $flag = TRUE;
        }

        if ($flag == TRUE){
          $user->save();
        }
        // echo $user;
        echo $request->photo;
        return;
        // return redirect('users/'.$username);
      }
}
