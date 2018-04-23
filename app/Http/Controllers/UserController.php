<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User as User;

class UserController extends Controller
{
    public function show() {
        return view('partials.privacy_policy');
    }
    public function edit() {
        $countries = DB::select('SELECT * FROM countries');
        return view('pages.profile_edit', ['countries' => $countries]);
    }

    public function update(Request $request, $username) {
        // $user = User::find($username);
        // $this->authorize('update', $article);
        // $user->update($request->all());
        return redirect('users/'.$username);
      }
}
